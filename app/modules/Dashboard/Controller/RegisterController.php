<?php

namespace Dashboard\Controller;

use Application\Mvc\Controller;
use Dashboard\Form\RegisterForm;
use Dashboard\Form\InviteForm;
use Phalcon\Mvc\View;
use Dashboard\Model\User;
use Dashboard\Model\UserToken;
use Dashboard\Model\Company;
use Dashboard\Model\CompanySystem;
use Phalcon\Http\Response;

require_once SWIFT_LIB_DIR . 'swift_required.php';

class RegisterController extends Controller
{
	/**
     * La acción de inicio, permite buscar
     */
    public function indexAction() {
        
    }

    public function sentAction($success = null) {
        $this->view->success = $success;
    }

    public function search() {

    }

    public function inviteAction($user){
        $inviteForm = new InviteForm();
        $this->view->inviteForm = $inviteForm;
        $this->session->set('manual', $this->objectToArray($user));
    }

    public function sendInvitationsAction(){
        $post = $this->request->getPost();
        if ($post["email1"] != null) {
            $email = $post["email1"];
            $this->sendMailAction($email)
        }

        if ($post["email2"] != null) {
            $email = $post["email2"];
            $this->sendMailAction($email)
        }

        if ($post["email3"] != null) {
            $email = $post["email3"];
            $this->sendMailAction($email)
        }

        $response = new Response;

        $response->redirect("Index/index/index");

        /*$this->dispatcher->forward(
            [
                "controller" => "register",
                "action" => "nextstep",
                "params" => [1, 'felmedranop@gmail.com']
            ]
        );*/
    }

    public function newAction($email)
    {

        $user = new User;

        $user->setName(null);
        $user->setEmail($email);
        $user->setPass(null);
        $user->setActive(0);
        $user->setSuspended(0);
        $user->setDeleted(0);

        if ($user->save()) {
            return $email;
        } else {
            return false;
        }

        $this->view->disable();
    }

    public function updateAction() {

        $post = $this->request->getPost();

        $company = new Company();
        $company->setName($post["company"]);
        

        try {

            if ($company->save()) {
                $companySys = new CompanySystem();

                $companySys->setCompanyId(Company::findFirstByName($post["company"])->getId());
                $companySys->setSystemId($post["system"]);

                try {

                    if ($companySys->save()) {
                        $user = User::findFirstById($post["id"]);

                        $user->setName($post["name"]);
                        $user->setPass($post["password"]);
                        $user->setActive(1);

                        try {

                            if($user->save());
                                $this->dispatcher->forward(
                                    [
                                        "controller"    => "register",
                                        "action"        => "invite",
                                        "params"        => [$user],
                                    ]
                                );

                        } catch (Exception $e) {
                            echo 'Ha ocurrido un error: ',  $e->getMessage(), "\n";
                        } 
                    }

                } catch (Exception $e) {
                    echo 'Ha ocurrido un error: ',  $e->getMessage(), "\n";
                }
            }
        } catch (Exception $e) {
            echo 'Ha ocurrido un error: ',  $e->getMessage(), "\n";
        }
        
    }


    public function sendMailAction($data = null) {
        if ($data != null) {
            $email = $data;
        } else {
            $email = $this->request->getPost();    
        }
        
        $saved_email = $this->newAction($email);

        if ($saved_email == false) {
            $this->flash->error('Ha ocurrido un error al almacenar el correo');
        } else { 

            $row = User::findFirstByEmail($saved_email);

            if ($row != null || $row != false) {

                $token = bin2hex(openssl_random_pseudo_bytes(16));
                $user_token = new UserToken;

                $user_token->setUserId($row->getId());
                $user_token->setToken($token);

                try {
                
                    if ($user_token->save()) {
                       $result = $this->swiftSend($token, $saved_email);
                       if ($result) {
                           $this->dispatcher->forward(
                                [
                                    "controller" => "register",
                                    "action" => "sent",
                                    "params" => [1]
                                ]
                            );
                        }
                    }

                } catch (Exception $e) {
                  echo 'Ha ocurrido un error: ',  $e->getMessage(), "\n";
                }
            }
        }
    }

    private function swiftSend($token = NULL, $saved_email) {
        $parameters = $this->objectToArray($this->config->swift);

        $transport = \Swift_SmtpTransport::newInstance($parameters['server'], $parameters['port'])
            ->setUsername($parameters['username'])
            ->setPassword($parameters['password']);

        $mailer = \Swift_Mailer::newInstance($transport);

        $message = \Swift_Message::newInstance('Confirmación de cuenta')
          ->setFrom(array($parameters['username'] => 'Multisistemas Team'))
          ->setTo(array($saved_email))
          ->addPart('<h1>Mensaje enviado desde Multisistemas Dashboard</h1>
               <p>Email: '.$saved_email.'</p>
               <p>Mensaje: Haga click en el siguiente enlace para verificar su correo:</p>'.
                '<p>http://'.$_SERVER['HTTP_HOST'].'/dashboard/register/validate/'.$token
                .'</p>', 'text/html');

        try {
            
            if ($result = $mailer->send($message)) {
                return true;
            }

        } catch (Exception $e) {
            echo 'Ha ocurrido un error: ',  $e->getMessage(), "\n";
        }
    }

    public function objectToArray($object)
    {
        if(!is_object($object) && !is_array($object))
        {
            return $object;
        }
        if(is_object($object))
        {
            $object = get_object_vars( $object );
        }
        return array_map(array($this,"objectToArray"), $object );
    }

    public function validateAction($token) {
        $user_token = UserToken::findFirstByToken($token);

        if ($user_token != false) {
            $user = User::findFirstById($user_token->getUserId());

            $id = $user->getId();
            $email = $user->getEmail();
            $this->dispatcher->forward(
                [
                    'controller'    => 'register',
                    'action'        => 'nextstep',
                    'params'        => [$id, $email],    
                ]
            );
        } else {
            $this->dispatcher->forward(
                [
                    'controller'    => 'register',
                    'action'        => 'invalid'    
                ]
            );
        }

    }

    public function invalidAction(){

    }

    public function nextstepAction($id, $email){
        $registerform = new RegisterForm;
        $this->view->setVars(
            [
                "id"            => $id,
                "email"         => $email,
                "registerform"  => $registerform,
            ]
        );
    }

    public function showAction($send) {
        
        if ($send == 1) {
            $this->dispatcher->forward(
            [
                "controller" => "register",
                "action" => "nextstep",
                "params" => [1, 'felmedranop@gmail.com']
            ]
        );
        } else {
            $this->dispatcher->forward(
            [
                "controller" => "index",
                "action" => "index"
            ]
        );
        }
        


    }
}

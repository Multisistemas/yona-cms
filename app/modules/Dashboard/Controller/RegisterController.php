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
use Dashboard\Model\CompanyUser;
use Dashboard\Model\System;
use Dashboard\Model\RoleUser;
use Phalcon\Http\Response;

require_once SWIFT_LIB_DIR . 'swift_required.php';

class RegisterController extends Controller
{
	
    public function indexAction() {
        
    }

    public function sentAction($success = null) {
        $this->view->success = $success;
    }

    public function searchAction($email, $verified = null) {
        $this->view->disable();

        if ($verified != null) {
            $user = User::findFirstByEmail($email);

            if ($user) {
                $this->dispatcher->forward(
                    [
                        'controller' => 'index',
                        'action' => 'index'
                    ]
                );
            }
        }
        

    }

    public function inviteAction($user = null) {
        $inviteForm = new InviteForm();
        $this->view->inviteForm = $inviteForm;
        
        //$this->setSession($user);
    }

    public function setSession($user) {
        $this->session->set('manual', $user->getAuthData());
    }

    public function sendInvitationsAction($bool){
        $post = $this->request->getPost();
        if ($post["email1"] != null) {
            $email = $post["email1"];
            $this->sendMailAction($email, $bool);
        }

        if ($post["email2"] != null) {
            $email = $post["email2"];
            $this->sendMailAction($email, $bool);
        }

        if ($post["email3"] != null) {
            $email = $post["email3"];
            $this->sendMailAction($email, $bool);
        }

        return $this->redirect($this->url->get() . 'index');

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
        $user = User::findFirstById($post["id"]);

        $company = new Company();
        $company->setName($post["company"]);

        try {

            if ($company->save()) {
                $companyFind = Company::findFirstByName($post["company"]);

                $this->saveCompanyUser($companyFind, $user);
                $this->saveRoleUser($user);
                $this->saveCompanySystem($companyFind->getId(), $post["system"]);

                $user->setName($post["name"]);
                $user->setPass($post["password"]);
                $user->setActive(1);
                $user->setSessionType("manual");

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

    public function saveCompanyUser($company, $user) {
        $company_user = new CompanyUser();

        $company_user->setCompanyId($company->getId());
        $company_user->setUserId($user->getId());

        $company_user->save();
    }

    public function saveRoleUser($user) {
        $role_user = new RoleUser();

        $role_user->setRoleId(1);
        $role_user->setUserId($user->getId());

        $role_user->save();
    }

    public function saveCompanySystem($companyId, $system) {
        $companySys = new CompanySystem();

        $companySys->setCompanyId($companyId);
        $companySys->setSystemId($system);

        $companySys->save();
    }

    public function sendMailAction($data = null, $bool = null) {
        if ($data != null) {
            $email = $data;
        } else {
            $email = $this->request->getPost("rmail");    
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
                       if ($bool == null) {
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
            
            if ($mailer->send($message)) {
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

    public function showAction() {
        
        $user = User::findFirstByEmail("lmedrano@multisistemas.com.sv");

        foreach ($user->companyUser as $userCom) {
            var_dump($userCom->company->name);
        }

    }
}

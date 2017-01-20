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

        if ($verified != null) {
            $user = User::findFirstByEmail($email);
            if ($user) {
                if($user->getVerified() == $verified){
                    $this->dispatcher->forward(
                        [
                            'controller'    => 'index',
                            'action'        => 'show',
                            'params'        => [$user],
                        ]
                    );
                } 
            } else {
                $this->saveOpauthData();
            }

        } else {
            $user = User::findFirstByEmail($email);
            if ($user) {
                return $user;
            } else {
                return false;
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
        $user->setVerified(0);

        if ($user->save()) {
            return $email;
        } else {
            return false;
        }

        $this->view->disable();
    }

    public function saveOpauthData(){
        $opauth = $this->session->get('opauth');

        $user = new User();
        
        $user->setName($opauth["auth"]["raw"]["name"]);
        $user->setEmail($opauth["auth"]["raw"]["email"]);
        $user->setPass(null);
        $user->setActive(1);
        $user->setSuspended(0);
        $user->setDeleted(0);
        $user->setVerified($opauth["auth"]["raw"]["verified_email"]);

        if ($user->save()) {
            $bool = true;
            $id = $user->getId();
            $email = $user->getEmail();
            $this->dispatcher->forward(
                [
                    'controller'    => 'register',
                    'action'        => 'nextstep',
                    'params'        => [$id, $email, $bool],    
                ]
            );
        } else {
            $this->redirect($this->url->get() . 'dashboard/index/login');
            $this->flash->error($this->helper->translate("Ha ocurrido un error al guardar el usuario, por favor inténtelo de nuevo"));
        }

    }

    public function updateOpauthAction(){
        $post = $this->request->getPost();
        $user = User::findFirstById($post["id"]);

        $company = new Company();
        $company->setName($post["company"]);

        if ($company->save()) {

            $companyFind = Company::findFirstByName($post["company"]);

            $this->saveCompanyUser($companyFind, $user);
            $this->saveRoleUser($user);
            $this->saveCompanySystem($companyFind->getId(), $post["system"]);

            $user->setName($post["name"]);
            $user->setPass($post["password"]);
            $user->setSessionType("opauth");

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

    public function sendMailAction($mail = null, $bool = null) {
        if ($mail != null) {
            $email = $mail;
        } else {
            $email = $this->request->getPost("rmail");    
        }
        
        if($user = $this->searchAction($email)) {
            if ($user->isActive()) {
                $this->redirect($this->url->get() . 'dashboard/index/login');
                $this->flash->error('Este usuario ya existe y actualmente se encuentra activado');
            } else if ($user->isActive() == false && $user->isSuspended() == true) {
                $this->redirect($this->url->get() . 'dashboard/index/login');
                $this->flash->error('Este usuario ya existe y actualmente se encuentra desactivado');
            } else if ($user->isActive() == false && $user->isSuspended() == false) {
                $result = $this->swiftSend($this->generateToken($user), $saved_email);
                if ($result) {
                    $this->redirect($this->url->get() . 'dashboard/index/login');
                    $this->flash->success($this->helper->translate("Correo enviado exitosamente! Por favor revise su bandeja de entrada"));
                } else {
                    $this->redirect($this->url->get() . 'dashboard/index/login');
                    $this->flash->warning($this->helper->translate("Ha ocurrido un error durante el envio, inténtelo de nuevo"));
                }
            }

        } else {

            $saved_email = $this->newAction($email);

            if ($saved_email == false) {
                $this->flash->error('Ha ocurrido un error al almacenar el correo');
            
            } else { 

                $user = User::findFirstByEmail($saved_email);

                if ($user != null) {
 
                    $result = $this->swiftSend($this->generateToken($user), $saved_email);

                    if ($result) {

                        $this->redirect($this->url->get() . 'dashboard/index/login');
                        $this->flash->success($this->helper->translate("Correo enviado exitosamente! Por favor revise su bandeja de entrada"));

                    } else {

                        $this->redirect($this->url->get() . 'dashboard/index/login');
                        $this->flash->warning($this->helper->translate("Ha ocurrido un error durante el envio, inténtelo de nuevo"));

                    }
                }
            }
        }   
    }

    public function generateToken($user) {
        $token = bin2hex(openssl_random_pseudo_bytes(16));
        $user_token = new UserToken;

        $user_token->setUserId($user->getId());
        $user_token->setToken($token);
        $user_token->setExpired(0);
        $user_token->save();

        return $token;
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

    public function nextstepAction($id, $email, $bool = null){
        $registerform = new RegisterForm;

        if ($bool != null) {

           $this->view->setVars(
                [
                    "id"            => $id,
                    "email"         => $email,
                    "registerform"  => $registerform,
                    "opauthID"      => $bool,
                ]
            ); 

        } else {

            $this->view->setVars(
                [
                    "id"            => $id,
                    "email"         => $email,
                    "registerform"  => $registerform,
                    "opauthID"      => $bool,
                ]
            );

        }
    }

    public function showAction() {
        
        var_dump($this->session->get('opauth'));

        /*$user = User::findFirstByEmail("lmedrano@multisistemas.com.sv");

        foreach ($user->companyUser as $userCom) {
            var_dump($userCom->company->name);
        }*/

    }
}

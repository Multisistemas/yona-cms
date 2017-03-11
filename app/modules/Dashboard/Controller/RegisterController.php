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
                $user = $this->saveOpauthData();

                if ($user) {
                    $opauth = true;
                    $id = $user->getId();
                    $email = $user->getEmail();
                    $this->dispatcher->forward(
                        [
                            'controller'    => 'register',
                            'action'        => 'nextstep',
                            'params'        => [$id, $email, $opauth],    
                        ]
                    );
                }
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

    public function inviteAction($id = null) {
        $inviteForm = new InviteForm();
        
        if ($id != null) {
            $this->view->setVars(
                [
                    "id" => $id,
                    "inviteForm" => $inviteForm,
                ]
            );
        } else {
            if ($this->session->has('opauth')) {
                $session = $this->session->get('opauth');
                $user = User::findFirstByEmail($session['auth']['raw']['email']);

                $id = $user->getId();

                $this->view->setVars(
                    [
                        "id" => $id,
                        "inviteForm" => $inviteForm,
                    ]
                );
            } else if ($this->session->has('manual')) {
                $session = $this->session->get('manual');
                $user = User::findFirstByEmail($session->email);

                $id = $user->getId();

                $this->view->setVars(
                    [
                        "id" => $id,
                        "inviteForm" => $inviteForm,
                    ]
                );
            }
        }
        
    }

    public function setSessionManual($user) {
        $this->session->set('manual', $user->getAuthData());
    }

    public function sendInvitationsAction($id) {
        $post = $this->request->getPost();

        foreach ($post as $key => $email) {
            if ($email != null || $email != '') {
                $exists = $this->validateIfExistsAction($email, $id);
                if ($exists) {
                    $this->redirect($this->url->get() . 'dashboard/register/invite');
                    $this->flash->warning($this->helper->translate("No se envió la invitación. Ya existe un usuario con el correo: ".$email));
                }
            }
        }

        $this->dispatcher->forward(
            [
                "controller"    => "index",
                "action"        => "show",
            ]
        );

    }

    public function validateIfExistsAction($email, $id) {
        $user = User::findFirstByEmail($email);
        if ( $user != null && $user->getActive() == 1 ) {
            return true;
        } else {
            $this->sendMailAction($email, $id);
            return false;
        }
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
        $user->setSessionType('opauth');

        if ($user->save()) {
            return $user;
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

            $this->saveCompanyUser($company, $user);
            $this->saveRoleUser($user);
            $this->saveCompanySystem($company->getId(), $post["system"]);

            $user->setPass($post["password"]);
            $user->setSessionType("opauth");

            try {

                if($user->save()) {
                    $id = $user->getId();
                    $this->dispatcher->forward(
                        [
                            "controller"    => "register",
                            "action"        => "invite",
                            "params"        => [$id],
                        ]
                    );
                }
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
                $user->setVerified(1);

                try {

                    if($user->save()) {
                        $id = $user->getId();
                        $this->setSessionManual($user);
                        $this->dispatcher->forward(
                            [
                                "controller"    => "register",
                                "action"        => "invite",
                                "params"        => [$id],
                            ]
                        );
                    }

                } catch (Exception $e) {
                        echo 'Ha ocurrido un error: ',  $e->getMessage(), "\n";
                } 
            }

        } catch (Exception $e) {
            echo 'Ha ocurrido un error: ',  $e->getMessage(), "\n";
        }
        
    }

    public function updateGuestAction() {

        $post = $this->request->getPost();
        $user = User::findFirstById($post["id"]);
        
        $company = Company::findFirstByName($post["company"]);
        $this->saveCompanyUser($company, $user);
        $this->saveRoleUser($user, true);

        $user->setName($post["name"]);
        $user->setPass($post["password"]);
        $user->setActive(1);
        $user->setSessionType("manual");
        $user->setVerified(1);

        try {

            if($user->save());
                $this->session->set('manual', $user->getAuthData());
                $this->dispatcher->forward(            
                    [
                        "controller"    => "index",
                        "action"        => "show",
                        "params"        => [$user],        
                    ]
                );

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

    public function saveRoleUser($user, $guest = false) {
        $role_user = new RoleUser();

        if ($guest) {
            $role_user->setRoleId(2);
            $role_user->setUserId($user->getId());
        } else {
            $role_user->setRoleId(1);
            $role_user->setUserId($user->getId());
        }

        $role_user->save();
    }

    public function saveCompanySystem($companyId, $system) {
        $companySys = new CompanySystem();

        $companySys->setCompanyId($companyId);
        $companySys->setSystemId($system);

        $companySys->save();
    }

    public function sendMailAction($mail = null, $id = null) {
        if ($mail != null) {
            $email = $mail;
        } else {
            $email = $this->request->getPost("rmail");    
        }
        
        if ($id != null) {
            
            $saved_email = $this->newAction($email);
            $user = User::findFirstByEmail($saved_email);
            $this->swiftSend($this->generateToken($user), $saved_email, $id);

        } else {

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
                            $this->flash->warning($this->helper->translate("Ha ocurrido un inconveniente durante el envio, inténtelo de nuevo"));

                        }
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

    private function swiftSend($token, $saved_email, $id = null) {
        $parameters = $this->objectToArray($this->config->swift);
        $user = User::findFirstByEmail($saved_email);

        $transport = \Swift_SmtpTransport::newInstance($parameters['server'], $parameters['port'])
            ->setUsername($parameters['username'])
            ->setPassword($parameters['password']);

        $mailer = \Swift_Mailer::newInstance($transport);

        if ($id != null) {
            $message = \Swift_Message::newInstance('Confirmación de cuenta')
              ->setFrom(array($parameters['username'] => 'Multisistemas Team'))
              ->setTo(array($saved_email))
              ->addPart('<h1>Mensaje enviado desde Multisistemas Dashboard</h1>
                   <p>Para: '.$saved_email.'</p>
                   <p>Mensaje: Se le ha enviado una invitación para unirse a Multisistemas Dashboard</p>
                   <p>Haga click en el siguiente enlace para registrarse con su equipo:</p>'.
                    '<p>http://'.$_SERVER['HTTP_HOST'].'/dashboard/register/validate/'.$token
                    .'/'.$id.'</p>'.
                    '<br>'.
                    '<p>Atentamente: <a href="http://www.multisistemas.com.sv">Multisistemas Team</a></p>', 'text/html');
        } else {
            $message = \Swift_Message::newInstance('Confirmación de cuenta')
              ->setFrom(array($parameters['username'] => 'Multisistemas Team'))
              ->setTo(array($saved_email))
              ->addPart('<h1>Mensaje enviado desde Multisistemas Dashboard</h1>
                   <p>Email: '.$saved_email.'</p>
                   <p>Mensaje: Haga click en el siguiente enlace para verificar su correo:</p>'.
                    '<p>http://'.$_SERVER['HTTP_HOST'].'/dashboard/register/validate/'.$token
                    .'</p>'.
                    '<br>'.
                    '<p>Atentamente: <a href="http://www.multisistemas.com.sv">Multisistemas Team</a></p>', 'text/html');
        }

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

    public function validateAction($token, $id = null) {
        $user_token = UserToken::findFirstByToken($token);

        if ($id != null) {

            if ($user_token != false && $user_token->getExpired() == 0) {
                $user_token->setExpired(1);
                $user_token->save();

                $user = User::findFirstById($user_token->getUserId());

                $userId = $user->getId();
                $email = $user->getEmail();
                $opauth = null;

                $this->dispatcher->forward(
                        [
                            'controller'    => 'register',
                            'action'        => 'nextstep',
                            'params'        => [$userId, $email, $opauth, $id],    
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

        } else {

            if ($user_token != false && $user_token->getExpired() == 0) {
                $user_token->setExpired(1);
                $user_token->save();

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

    }

    public function invalidAction(){

    }

    public function nextstepAction($id, $email, $opauth = null, $userId = null){
        $registerform = new RegisterForm();
        $company = null;

        if ($userId != null) {
            $user = User::findFirstById($userId);
            foreach ($user->companyUser as $userCom) {
                $theCompany = $userCom->company->name;
            }

            $company = $theCompany;
        }
        

        $this->view->setVars(
            [
                "id"            => $id,
                "email"         => $email,
                "registerform"  => $registerform,
                "opauthId"      => $opauth,
                "userId"        => $userId,
                "company"       => $company,
            ]
        );

    }

    public function showAction() {
        
        //var_dump($this->session->get('opauth'));

        $user = User::findFirstByEmail("lmedrano@multisistemas.com.sv");
        
        /*foreach ($user->companyUser as $userCom) {
            $companyId = $userCom->company->id;
        }

        $usersCompany = CompanyUser::find(
            [
                "company_id" => $companyId,
            ]
        );

        foreach ($usersCompany as $userC) {
            $users[] = User::findFirstById($userC->getId());    
        }

        $users_total = array_shift($users);


        if (!empty($users)) {
            var_dump($users);
        } else {
            echo 'esta vacio';
        }
         

        
        $companySys = CompanySystem::findFirstByCompanyId($company->getId());

        $system = $companySys->system->shortname;

        var_dump($system);

        if ($this->session->has('manual')) {
            $auth = $this->session->get('manual');
            $user = User::findFirstById($auth->id);
        } else if($this->session->has('opauth')) {
            $auth = $this->session->get('opauth');
            $user = User::findFirstByEmail($auth['auth']['raw']['email']);
        }

        $role = RoleUser::findFirstByUserId($user->getId());

        if ($role == 1) {
            foreach ($user->companyUser as $userCom) {
                $company = $userCom->company;
            }

        }*/

        foreach ($user->companyUser as $userCom) {
            $companyId = $userCom->company->id;
        }

        $systems_company = CompanySystem::find(
            [
                "company_id" => $companyId,
            ]
        );

        if (!empty($systems_company)) {

            foreach ($systems_company as $sys) {
                $date = date_create($sys->getCreatedAt());
                var_dump(date_format($date, 'd/m/y'));
            }

        }
    }
}

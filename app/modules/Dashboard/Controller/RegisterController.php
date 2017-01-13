<?php

namespace Dashboard\Controller;

use Application\Mvc\Controller;
use Dashboard\Form\RegisterForm;
use Phalcon\Mvc\View;
use Dashboard\Model\User;
use Dashboard\Model\UserToken;
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

    /**
     * Realiza la búsqueda basada en los parámetros de usuario
     * devolviendo un paginador
     */
    public function searchAction()
    {
        // ...
    }

    /**
     * Muestra la vista de crear
     */
    public function newAction($post)
    {

        $user = new User;

        $user->setName(null);
        $user->setEmail($post["rmail"]);
        $user->setPass(null);
        $user->setActive(0);
        $user->setSuspended(0);
        $user->setDeleted(0);

        if ($user->save()) {
            return $post["rmail"];
        } else {
            return false;
        }

        $this->view->disable();
    }

    /**
     * Muestra la vista para editar
     */
    public function editAction()
    {
        // ...
    }

    /**
     * Crea
     */
    public function createAction()
    {
        // ...
    }

    /**
     * Actualiza
     */
    public function saveAction()
    {
        // ...
    }

    /**
     * Elimina
     */
    public function deleteAction($id)
    {
        // ...
    }

    public function sendMailAction() {
        
        $post = $this->request->getPost();
        $saved_email = $this->newAction($post);

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
                       $this->dispatcher->forward(
                            [
                                "controller" => "register",
                                "action" => "sent",
                                "params" => [1],
                                "namespace" => "Dashboard\Controller"
                            ]
                        );
                    }

                } catch (Exception $e) {
                  echo 'Ha ocurrido un error: ',  $e->getMessage(), "\n";
                }
            }
        }

    	$this->view->disable();
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

    public function showAction() {
        //echo $token = bin2hex(openssl_random_pseudo_bytes(16));
        //echo function_exists('proc_open') ? "Yep, that will work" : "Sorry, that won't work";
        //var_dump("http://".$_SERVER['HTTP_HOST'].'/dashboard/login/loginManual');

        /*$parameters = $this->objectToArray($this->config->swift);

        $transport = \Swift_SmtpTransport::newInstance($parameters['server'], $parameters['port'])
            ->setUsername($parameters['username'])
            ->setPassword($parameters['password']);

        $mailer = \Swift_Mailer::newInstance($transport);


        $message = \Swift_Message::newInstance('Confirmación de cuenta')
          ->setFrom(array('no-reply@multisistemax.com' => 'Multisistemas Team'))
          ->setTo(array('lmedrano@multisistemas.com.sv'))
          ->addPart('<h1>Mensaje enviado desde Multisistemas Dashboard</h1>
               <p>Email: lmedrano@multisistemas.com.sv</p>
               <p>Mensaje: Haga click en el siguiente enlace para verificar su correo:</p>'.
                '<p>http://'.$_SERVER['HTTP_HOST'].'/dashboard/register/validate/'
                .'</p>', 'text/html');

        try {
            
            if ($result = $mailer->send($message)) {
                echo "Mensaje enviado con exito";
            }

        } catch (Exception $e) {
            echo 'Ha ocurrido un error: ',  $e->getMessage(), "\n";
        } */

        // Getting a response instance
        $this->dispatcher->forward(
            [
                "controller" => "register",
                "action" => "sent",
                "params" => [1],
                "namespace" => "Dashboard\Controller",
            ]
        );


    }
}

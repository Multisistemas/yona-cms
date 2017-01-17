<?php

namespace Dashboard\Controller;

use Application\Mvc\Controller;
use Phalcon\Mvc\View;
use Phalcon\Http\Response;
use Dashboard\Model\User;

require_once OPAUTH_LIB_DIR . 'Opauth.php';

class LoginController extends Controller
{

    private $parameters;

    public function indexAction() {
    	$this->view->pick('index/index');
    }

    public function showAction() {
         //var_dump($this->session->has('opauth'));
    }

    public function loginOpauthAction() {

        $this->session->set('opauth', $this->login());
        $this->view->disable();
    }

    public function loginManualAction(){
        if ($this->request->isPost()) {

                    $email = $this->request->getPost('email');
                    $password = $this->request->getPost('password');
                    $user = User::findFirstByEmail($email);
                    if ($user) {
                        if ($user->checkPassword($password)) {
                            if ($user->isActive()) { 
                                $this->session->set('manual', $user->getAuthData());
                                $this->dispatcher->forward(
                                    [
                                        "controller"    => "index",
                                        "action"        => "show",
                                    ]
                                );
                            } else {
                                $this->flash->error($this->helper->translate("User is not activated yet"));
                            }
                        } else {
                            $this->flash->error($this->helper->translate("Incorrect login or password"));
                        }
                    } else {
                        $this->flash->error($this->helper->translate("Incorrect login or password"));
                    }
              

        }
    }

    public function login() {
        $this->parameters = $this->objectToArray($this->config->opauth);

        if(is_array($this->parameters)) {
            $parameter = $this->parameters;
        }

        $opauth = new \Opauth($parameter);

        $opauth->run();
    }

    public function logoutAction()
    {   
        if ($this->session->has('opauth')) {
            $this->session->remove('opauth');
        } else if ($this->session->has('manual')) {
            $this->session->remove('manual');
        }

        $this->indexAction();
    }

    /**
     * Convert  object into array
     * @param   $object is object
     * @return  array
     */
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

    public function destroyAction()
    {
        $this->session->remove("opauth");

        if($this->session->has("opauth"))
        {
            echo $this->session->get("opauth");
        }
        else
        {
            echo "La sesión no existe";
        }
    
    }

}

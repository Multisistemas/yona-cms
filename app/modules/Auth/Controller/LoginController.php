<?php

namespace Auth\Controller;


use Application\Mvc\Controller;
use Phalcon\Mvc\View;

require_once OPAUTH_LIB_DIR . 'Opauth.php';

class LoginController extends Controller
{

    private $parameters;

    public function indexAction() {
    	echo '<h1> Hello Guys!</h1>';
    }

    public function showAction() {
        var_dump($this->config->opauth);
    }

    public function loginOpauthAction() {
        $this->session->set('opauth', $this->login());
        $this->view->disable();
    }

    public function login() {
        $this->parameters = $this->objectToArray($this->config->opauth);

        if(is_array($this->parameters)) {
            $parameter = $this->parameters;
        }

        $opauth = new \Opauth($parameter);

        $opauth->run();
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

    public function successAction() {
        $auths = $this->session->get('opauth');
        
        if($auths['auth']['raw']['hd'] != 'multisistemas.com.sv') {
            $this->view->pick('login/invalid');
            $this->view->message = "Only Multisistemas employees allowed!";
        } else {
            $this->view->pick('login/success');
            $modules = array( 'modules' => array(
                    'ERP: Entreprise Resources Planning' => 'https://mseicorp.com/erp',
                    'DMS: Document Management System' => 'https://mseicorp.com/wiki',
                    'LMS: Learning Management System' => 'https://mseicorp.com/lms',
                    'Multisistemas Website' => 'http://multisistemas.com.sv',
                    'Gestión Total Website' => 'http://gestiontotal.net',
                    'Google Drive' => 'http://docs.multisistemas.com.sv',
                    'Google Mail' => 'https://mail.google.com',
            ));
             
            $manuals = array( 'manuals' => array(
                    'Manual de Usuario ERP' => 'http://manualdolibarr.com/guia-dolibarr37.php',
                    'Manual de Usuario DMS' => 'https://www.dokuwiki.org/start?id=es:manual',
                    'Guía rápida LMS' => 'https://docs.moodle.org/all/es/Gu%C3%ADa_r%C3%A1pida_del_usuario',
            ));

            $this->view->auths = array_merge($auths, $modules, $manuals);
         }

    }

}

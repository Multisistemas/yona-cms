<?php

namespace Dashboard\Controller;

use Application\Mvc\Controller;
use Dashboard\Form\RegisterForm;
use Phalcon\Mvc\View;
use Dashboard\Model\User;

class RegisterController extends Controller
{
	/**
     * La acción de inicio, permite buscar
     */
    public function indexAction()
    {
        // ...
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

        $user = new User();
        //var_dump($user);
/*
        $user->setName(null);
        $user->setEmail($post["email"]);
        $user->setPass(null);
        $user->setActive(0);
        $user->setSuspended(0);
        $user->setDeleted(0);

        var_dump($user);

        if ($user->save()) {
            echo 'El correo se almaceno correctamente';
        } else {
            echo 'Error al guardar';
        }

        $this->view->disable();*/
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

    	//var_dump($this->request->getPost());
        
        $post = $this->request->getPost();
        $this->newAction($post);

    	//$this->view->disable();
    }
}

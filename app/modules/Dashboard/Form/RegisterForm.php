<?php

namespace Dashboard\Form;

use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Email;
use Phalcon\Validation\Validator\PresenceOf;

class RegisterForm extends \Phalcon\Forms\Form
{

    public function initialize()
    {
        $id = new Text('id', array(
            'required'      => true,
            'placeholder'   => 'Ingrese su correo',
            'class'         => 'form-control',
            'disabled'      => 'disabled',
        ));
        $id->addValidator(new PresenceOf(array('message' => 'El id es requerido')));
        $this->add($id);

        $name = new Text('name', array(
            'required'      => true,
            'placeholder'   => 'Ingrese su primer nombre y primer apellido',
            'class'         => 'form-control',
        ));
        $name->addValidator(new PresenceOf(array('message' => 'El nombre es requerido')));
        $this->add($name);

        $email = new Email('email', array(
            'required'      => true,
            'placeholder'   => 'Ingrese su correo',
            'class'         => 'form-control',
        ));
        $email->addValidator(new PresenceOf(array('message' => 'El correo es requerido')));
        $this->add($email);

        $password = new Password('password', array(
            'required'      => true,
            'placeholder'   => 'Ingrese una contraseña',
            'class'         => 'form-control',
            'id'            => 'pass',
        ));
        $password->addValidator(new PresenceOf(array('message' => 'La contraseña es requerida')));
        $this->add($password);

<<<<<<< HEAD
        $rmail = new Email('rmail', array(
            'required' => true,
            'placeholder' => 'Ingrese su correo',
            'class' => 'form-control',
            'id' => 'rmail',
=======
        $password2 = new Password('password2', array(
            'required'      => true,
            'placeholder'   => 'Repita la contraseña',
            'class'         => 'form-control',
            'id'            => 'pass2',
            'onkeyup'       => 'validatePass();',
        ));
        $password2->addValidator(new PresenceOf(array('message' => 'La contraseña es requerida')));
        $this->add($password2);

        $rmail = new Email('rmail', array(
            'required'      => true,
            'placeholder'   => 'Ingrese su correo',
            'class'         => 'form-control',
            'id'            => 'rmail',
>>>>>>> 47bfee9e74836986f83d6fd435816b619f7b40d8
        ));
        $rmail->addValidator(new PresenceOf(array('message' => 'El correo es requerido')));
        $this->add($rmail);

        $company = new Text('company', array(
            'required'      => true,
            'placeholder'   => 'Ingrese el nombre de la empresa',
            'class'         => 'form-control',
        ));
        $company->addValidator(new PresenceOf(array('message' => 'Debe ingresar el nombre de su empresa')));
        $this->add($company);

    }

}

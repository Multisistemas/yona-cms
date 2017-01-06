<?php

namespace Auth\Form;

use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Validation\Validator\PresenceOf;

class LoginForm extends \Phalcon\Forms\Form
{

    public function initialize()
    {
        $email = new Text('email', array(
            'required' => true,
            'placeholder' => 'Ingrese su correo',
        ));
        $email->addValidator(new PresenceOf(array('message' => 'El correo es requerido')));
        $this->add($email);

        $password = new Password('password', array(
            'required' => true,
            'placeholder' => 'Ingrese su contraseña',
        ));
        $password->addValidator(new PresenceOf(array('message' => 'La contraseña es requerida')));
        $this->add($password);

    }

}

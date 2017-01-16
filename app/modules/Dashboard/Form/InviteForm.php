<?php

namespace Dashboard\Form;

use Phalcon\Forms\Element\Email;
use Phalcon\Validation\Validator\PresenceOf;

class InviteForm extends \Phalcon\Forms\Form
{

    public function initialize()
    {
        $email1 = new Email('email1', array(
            'placeholder' => 'Ingrese un correo',
            'class' => 'form-control',
        ));
        $this->add($email1);

        $email2 = new Email('email2', array(
            'placeholder' => 'Ingrese un correo',
            'class' => 'form-control',
        ));
        $this->add($email2);

        $email3 = new Email('email3', array(
            'placeholder' => 'Ingrese un correo',
            'class' => 'form-control',
        ));
        $this->add($email3);
    }

}
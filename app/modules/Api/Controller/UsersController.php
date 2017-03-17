<?php

namespace Api\Controller;

use Dashboard\Model\User;

/**
 * Class IndexController.
 *
 * @package Api\Controller
 */
class UsersController extends \Api\Controller\RestController
{
    /**
     * API start page.
     *
     * @throws \Api\Exception\NotImplementedException
     */
    public function indexAction()
    {
	    $users = User::find();
	    
        $payload = new \Api\Model\Payload($users);

        $this->render($payload);
    }
}

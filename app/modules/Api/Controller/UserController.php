<?php

namespace Api\Controller;

/**
 * Class IndexController.
 *
 * @package Api\Controller
 */
class UserController extends \Api\Controller\RestController
{
    /**
     * API start page.
     *
     * @throws \Api\Exception\NotImplementedException
     */
    public function indexAction()
    {
        $payload = new \Api\Model\Payload('Welcome to api user controller index action!');

        $this->render($payload);
    }
}

<?php

namespace Auth;

class Routes
{

    public function init($router)
    {
    		 $router->addML('/auth/', array(
            //'module' => 'index',
            'controller' => 'index',
            //'action' => 'index',
        ), 'auth');

    		$router->addML('/auth/', array(
            //'module' => 'index',
            'controller' => 'login',
            //'action' => 'index',
        ), 'auth');

        return $router;
    }

}
<?php

namespace Dashboard;

class Routes
{

    public function init($router)
    {
    	$router->addML('/dashboard/', array(
            'module' => 'dashboard',
            'controller' => 'index',
            'action' => 'index',
        ), 'dashboard');

        $router->addML('/dashboard/', array(
            'module' => 'dashboard',
            'controller' => 'register',
            'action' => 'index',
        ), 'dashboard');

        $router->addML('/', array(
            'module' => 'index',
            'controller' => 'index',
            'action' => 'index',
        ), 'index');

        return $router;
    }

}
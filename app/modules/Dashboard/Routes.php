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

        return $router;
    }

}
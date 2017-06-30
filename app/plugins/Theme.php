<?php
    /**
     * @copyright Copyright (c) 2011 - 2014 Oleksandr Torosh (http://wezoom.net)
     * @author Oleksandr Torosh <web@wezoom.net>
     */

namespace MultiCMS\Plugin;

use \Phalcon\Mvc\User\Plugin;

class Theme extends Plugin
{

    public function __construct($di)
    {
        $helper = $di->get('helper');
        if (!$helper->meta()->get('theme')) {
            $helper->theme($helper->translate('THEME'));
        }
    }

} 
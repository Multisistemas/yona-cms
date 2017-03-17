<?php

return [
    'base_path' => '/',

    'database'  => [
        'adapter'  => 'Mysql',
        'host'     => 'localhost',
        'username' => 'root',
        'password' => 'toor',
        'dbname'   => 'yona',
        'charset'  => 'utf8',
    ],

    'memcache'  => [
        'host' => 'localhost',
        'port' => 3306,
    ],

    'memcached'  => [
        'host' => 'localhost',
        'port' => 3306,
    ],

    'cache'     => 'file', // memcache, memcached

    
    // Opauth configuration
    'opauth' => [
        'path' => '/dashboard/login/loginOpauth/',
        'callback_url' => 'http://yona.dev/dashboard/login/success',
        'security_salt' => 'LHFm11lYf3Fyw5W10a44aa5x4W1KsVrieQCnpBzzpTBMA5vJidQKDo8pMJbmw22A1C8v',
        'debug' =>true,
        'Strategy' => [
            'Google' => [
                'client_id' => '708944901374-55hfdptar6ej5n01nkg7adsmd13dtr6p.apps.googleusercontent.com',
                'client_secret' => 'pMX7H5Lr_oB7pC-oooKtgIVL',
                'redectUrl' =>'http://yona.dev/dashboard/login/loginOpauth/google/oauth2callback',
            ],
        ],
    ],

    'swift' => [
        'server'    => 'a2ss35.a2hosting.com',
        'port'      => 25,
        'username'  => 'no-reply@multisistemax.com',
        'password'  => 'VKPSkevoC2+h',
    ],
    luis
];
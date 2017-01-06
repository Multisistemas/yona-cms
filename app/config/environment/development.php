<?php

return [
    'base_path' => '/',
    //'base_path' => 'http://localhost/yona-cms/web/',

    'database'  => [
        'adapter'  => 'Mysql',
        'host'     => 'localhost',
        'username' => 'yona',
        'password' => 'yona',
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
    
    'path' => '/auth/login/loginOpauth/',
    'callback_url' => 'http://yona.dev/auth/login/success',
    'security_salt' => 'LHFm11lYf3Fyw5W10a44aa5x4W1KsVrieQCnpBzzpTBMA5vJidQKDo8pMJbmw22A1C8v',
    'debug' =>true,
    'Strategy' => [
        'Google' => [
               'client_id' => '708944901374-55hfdptar6ej5n01nkg7adsmd13dtr6p.apps.googleusercontent.com',
               'client_secret' => 'pMX7H5Lr_oB7pC-oooKtgIVL',
               'redectUrl' =>'http://yona.dev/auth/login/loginOpauth/google/oauth2callback',
            ],
        ],
    ],
];
<?php

chdir(dirname(__DIR__));

define('ROOT', __DIR__);
define('HOST_HASH', substr(md5($_SERVER['HTTP_HOST']), 0, 12));

define('OPAUTH_LIB_DIR', dirname(dirname(__FILE__)).'/vendor/opauth/opauth/lib/Opauth/');
define('SWIFT_LIB_DIR', dirname(dirname(__FILE__)).'/vendor/swiftmailer/swiftmailer/lib/');


if (isset($_SERVER['APPLICATION_ENV'])) {
    $applicationEnv = ($_SERVER['APPLICATION_ENV'] ? $_SERVER['APPLICATION_ENV'] : 'production');
} else {
    $applicationEnv = (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production');
}
define('APPLICATION_ENV', $applicationEnv);


define('APPLICATION_PATH', __DIR__ . '/../app');

require_once APPLICATION_PATH . '/Bootstrap.php';

$bootstrap = new YonaCMS\Bootstrap();
$bootstrap->run();

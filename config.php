<?php

$_ENV = parse_ini_file(__DIR__ . '/.env');
/**
 * Used to generate database configuration
 * Save your database configuration here
 */

return array(
    'host' => $_ENV['HOST_DB'],
    'user' => $_ENV['USER_DB'],
    'password' => $_ENV['PASSWORD_DB'],
    'port'=> $_ENV['PORT_DB'],
    'name' => $_ENV['NAME_DB']
);

<?php
// App Information
//define('URL', 'http://localhost:80');
define('URL', 'http://localhost');
define('APP_NAME', 'My PHP App');

// Database Information
define('DATABASE_HOST', 'database');
define('DATABASE_PORT' , '3306');
define('DATABASE_NAME', 'treball_andorra');
define('DATABASE_USER', 'root');
define('DATABASE_KEY', $_ENV['MYSQL_ROOT_PASSWORD']);
define('DATABASE_CHARSET', 'utf8mb4');

// PHP Mailer Information
define('HOST' , 'smtp.hostinger.com');
define('PORT', 587);
define('USER_ACOUNT', 'example@treballandorra.org');
define('KEY_ACOUNT', 'mypassword');

// Common Paths
define('MIDDLEWARE', $_SERVER['DOCUMENT_ROOT'] . '/midlewares');
define('VENDOR_AUTOLOAD', $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');
define('EMAILS', $_SERVER['DOCUMENT_ROOT'] . '/emails');
define('FUNCTIONS', $_SERVER['DOCUMENT_ROOT'] . '/functions/');


define('AVATARS', URL . '/public/app_images/avatars/');
define('AVATARS_LOCAL', $_SERVER['DOCUMENT_ROOT'] . '/public/app_images/avatars/');
define('AVATARS_DEFAULT', $_SERVER['DOCUMENT_ROOT'] . '/public/app_images/avatars/defaults');
define('AVATARS_USER', URL . '/public/app_images/avatars/users/');

define('POST', URL . '/public/app_images/posts/');
define('POST_DEFAULT', $_SERVER['DOCUMENT_ROOT'] . '/public/app_images/posts/defaults');
define('POST_USER', URL . '/public/app_images/posts/users/');
?>
<?php

session_start();
header('Content-Type: text/html; charset=utf-8');
define('TIMEZONE', 'Europe/Athens');

$GLOBALS['config'] = require('app/config/config.php');

spl_autoload_register( function ($className) {
   $className = ltrim($className, '\\');
   $fileName  = '';
   $namespace = '';

   if ($lastNsPos = strrpos($className, '\\')) {
      $namespace = substr($className, 0, $lastNsPos);
      $className = substr($className, $lastNsPos + 1);
      $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
   }

   $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

   require $fileName;
});

new app\src\Auth();

require_once('app/core/alias.php');
require_once('app/functions/helpers.php');
require_once('app/core/routes.php');
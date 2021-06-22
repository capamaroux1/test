<?php

use app\src\Url;
use app\src\View;

/**
 * Clear or filter data inputs from users.
 *
 * @param string $string
 * @return string
 */
function escape($string) 
{
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
}

/**
 * Generate a public path for the application.
 *
 * @param string $string
 * @return string
 */
function asset($path) 
{
    return Url::generatePath('public/'.$path);
}

/**
 * Generate a url for the application.
 *
 * @param string $string
 * @return string
 */
function route($path) 
{
    return Url::generatePath($path);
}

/**
 * Stop the application with a 404 header response. 
 *
 * @return string
 */
function abort404() 
{
    header("HTTP/1.0 404 Not Found");
  
    return View::render('errors.404');
}

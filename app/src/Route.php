<?php

namespace app\src;

class Route 
{
  private static $routes = [];

  /**
    * Add a new route
    * 
    * @param string $expression route string or expression
    * @param callable|array $function function to call if route with allowed method is found
    * @param string $method http method of the route
    *
    */
  public static function add($expression, $function, $method = 'get')
  {
    if ($function instanceof \Closure) {
      array_push(self::$routes, [
        'expression' => $expression,
        'function' => $function,
        'method' => $method
      ]);      
    } else {
      array_push(self::$routes, [
        'expression' => $expression,
        'function' =>  function() use ($function){
          $controller = new $function[0];
          $function = $function[1];

          return $controller->$function();
        },
        'method' => $method
      ]);      
    }
  }

  /**
   * Get all defined routes.
   * 
   * @return array
   */
  public static function getAll()
  {
    return self::$routes;
  }

  /**
   * Run the given path.
   * 
   * @param string $requestUrl
   * @return mixed
   */
  public static function run($requestUrl = '/')
  {   
    // Get current request method
    $method = $_SERVER['REQUEST_METHOD'];
    $route_match_found = false;

    foreach (self::$routes as $route) {
     // Add 'find string start' automatically
      $route['expression'] = '^'.$route['expression'].'$';
      preg_match('#'.$route['expression'].'#', $requestUrl, $matches);

      // Check path match
      if (count($matches) > 0) {

        // Check method match
        if (strtolower($method) == strtolower($route['method'])) {
          array_shift($matches); // Always remove first element. This contains the whole string

          $return_value = call_user_func_array($route['function'], $matches);

          if ($return_value) {
            echo $return_value;
          }

          $route_match_found = true;

          break;
        }
      }  
    }

    // No matching route was found
    if (!$route_match_found) {
      return abort404();
    }    
  }

  /**
    * Add a new post route
    * 
    * @param string $expression route string or expression
    * @param callable|array $function function to call if route with allowed method is found
    */
  public static function post($expression, $function)
  {
    self::add($expression, $function, 'post');
  }
}

<?php 

namespace App\Router;

/**
 * Class responsible for parsing the request params and finding the appropriate contorller and action for the 
 */
class Router {
  // Mapping controllerName -> ControllerClass
  /** @var Array $routes */
  private $routes = [
    '' => '\App\Controllers\NoRoute',
    'jobs' => '\App\Controllers\Jobs',
  ];

  /**
   * Checks the controller name from the request param
   * and returns if appropriate controller exists, otherwise returns noroute controller
   * 
   * @return Object
   */
  public function getController() {
    $controllerName = array_key_exists('c', $_GET) ? $_GET['c'] : '';

    if (!array_key_exists($controllerName, $this->routes)) {
      $controllerName = '';
    }

    return new $this->routes[$controllerName]();
  }
}

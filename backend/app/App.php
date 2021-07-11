<?php

namespace App;

use App\Router\Router;

class App {
  /** @var Router $router */
  private $router;

  public function __construct() {
    $this->router = new Router();
  }

  /**
   * Handles the request
   * The controller and action params should be indicated in query params 'c' and 'a'
   * In the big scale applications the routing should be done by parsing the request url instead of relying on the query params
   */
  public function handleRequest() {
    $controller = $this->getController();
    $action = array_key_exists('a', $_GET) ? $_GET['a'] : 'index';

    // The error thowing must not be visible for users in production
    // Good thing could be to implement dev and prod modes and restrict exception messages showing and hiding, but for test case application its fine
    if (!method_exists($controller, $action)) {
      throw new \Exception('Requested Action Doesn\'n exist');
    }

    return $controller->$action();
  }

  /**
   * Gets the controller class
   * Wrapped with decorator in case if modifications will be needed before/after controller is found
   */
  private function getController() {
    return $this->router->getController();
  }
}

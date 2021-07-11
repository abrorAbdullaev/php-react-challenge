<?php

use PHPUnit\Framework\TestCase;
use App\Router\Router;
use App\Controllers\NoRoute;
use App\Controllers\Jobs;

final class RouterTest extends TestCase {
  /**
   * @var Router $router
   */
  protected static $router;

  public static function setUpBeforeClass(): void {
    self::$router = new Router();
  }

  public function testClassCreated() {
    self::assertInstanceOf(Router::Class, self::$router);
  }

  public function testNoRouteControllerWithWrongRoute() {
    $_GET['c'] = 'blablablaiamdoingautomatedtests';
    $controllerName = self::$router->getController();

    self::assertInstanceOf(NoRoute::Class, $controllerName);
  }

  public function testNoRouteControllerWithNumbers() {
    $_GET['c'] = 12123;
    $controllerName = self::$router->getController();

    self::assertInstanceOf(NoRoute::Class, $controllerName);
  }

  public function testNoRouteControllerWithEmptyRoute() {
    $controllerName = self::$router->getController();
    self::assertInstanceOf(NoRoute::Class, $controllerName);
  }

  public function testCorrectJobsController() {
    $_GET['c'] = 'jobs';
    $controllerName = self::$router->getController();

    self::assertInstanceOf(Jobs::Class, $controllerName);
  }

  public function testRoutes() {
    $reflection = new ReflectionObject(self::$router);
    $prop = $reflection->getProperty('routes');
    $prop->setAccessible(true);
    $routes = $prop->getValue(self::$router);

    self::assertEquals($routes, [
      '' => '\App\Controllers\NoRoute',
      'jobs' => '\App\Controllers\Jobs',
    ]);
  }
}

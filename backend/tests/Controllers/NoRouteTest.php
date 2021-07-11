<?php

use PHPUnit\Framework\TestCase;
use App\Controllers\NoRoute;

class NoRouteTest extends TestCase {
  /**
   * @var NoRoute $noRoute
   */
  protected static $noRoute;

  public function setUp(): void {
    self::$noRoute = new NoRoute();
  }

  public function testNoRouteResponse() {
    $result = self::$noRoute->index();
    self::assertEquals(print(json_encode(['message' => 'Requested Route Is Not Found!'], true)), $result);
  }
}
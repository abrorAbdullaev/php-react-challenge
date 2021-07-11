<?php

use PHPUnit\Framework\TestCase;
use App\Core\AbstractController;

class MockController extends AbstractController {}

class AbstractControllerTest extends TestCase {
  /**
   * @var AbstractController $controller
   */
  protected static $controller;

  public function setUp(): void {
    self::$controller = new MockController();
  }

  public function testSendResponse() {
    $result = self::$controller->sendResponse(['test' => 'rest']);
    self::assertEquals(print(json_encode(['test' => 'rest'], true)), $result);
  }
}
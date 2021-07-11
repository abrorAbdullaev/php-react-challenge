<?php

namespace App\Core;

abstract class AbstractController {
  /**
   * @var Array $data
   */
  public function sendResponse($data) {
    if (!headers_sent()) {
      header('Content-Type: application/json');
    }

    return print(json_encode($data, true));
  }
}

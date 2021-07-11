<?php

namespace App\Controllers;

use App\Core\AbstractController;

class NoRoute extends AbstractController {
  public function index() {
    return $this->sendResponse([
      'message' => 'Requested Route Is Not Found!',
    ]);
  }
}
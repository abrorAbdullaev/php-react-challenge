<?php

namespace App\Controllers;

use \App\Core\AbstractController;
use \App\Models\Resource\Job as JobsResource;

class Jobs extends AbstractController {
  /** @var JobsResource $jobsResource */
  protected $jobsResource;

  public function __construct() {
    $this->jobsResource = new JobsResource();
  }

  // Serves as getAll() endpoint
  public function index() { 
    $jobs = array_map(function($job) {
      return $job->__toArray();
    }, $this->jobsResource->getAll($this->getFilters()));
    
    return $this->sendResponse([
      'jobs' => array_values($jobs), // Has to use array_values to reset the array keys
    ]);
  }

  /**
   * @return Array
   */
  protected function getFilters() {
    $filters = [];

    foreach (JobsResource::$filterableProps as $prop) {
      if (array_key_exists($prop, $_GET)) {
        $filters[$prop] = $_GET[$prop];
      }
    }

    return $filters;
  }
}

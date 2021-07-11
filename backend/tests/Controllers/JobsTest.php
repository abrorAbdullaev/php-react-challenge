<?php

use PHPUnit\Framework\TestCase;
use App\Controllers\Jobs;
use App\Models\Job as JobModel;

class JobsTest extends TestCase {
  /**
   * @var Jobs $jobsContoller
   */
  protected static $jobsController;

  public function setUp(): void {
    unset($_GET['location']);
    unset($_GET['department']);
    unset($_GET['type']);
    self::$jobsController = new Jobs();
  }

  public function testGetFiltersWhenNotPassed() {
    $reflection = new ReflectionObject(self::$jobsController);
    $method = $reflection->getMethod('getFilters');
    $method->setAccessible(true);
    
    $filters = $method->invoke(self::$jobsController);

    self::assertEquals([], $filters);
  }

  public function testGetFiltersWhenPassed() {
    $_GET['location'] = 'berlin';
    $_GET['type'] = 'full time';

    $reflection = new ReflectionObject(self::$jobsController);
    $method = $reflection->getMethod('getFilters');
    $method->setAccessible(true);
    
    $filters = $method->invoke(self::$jobsController);

    self::assertEquals([
      'location' => 'berlin',
      'type' => 'full time'
    ], $filters);
  }

  public function testGetFiltersWhenWrongKeysPassed() {
    $_GET['ss'] = 'berlin';
    $_GET['aa'] = 'full time';

    $reflection = new ReflectionObject(self::$jobsController);
    $method = $reflection->getMethod('getFilters');
    $method->setAccessible(true);
    
    $filters = $method->invoke(self::$jobsController);

    self::assertEquals([], $filters);
  }

  public function testGetFiltersWhenWrongValuesPassed() {
    $_GET['location'] = '';
    $_GET['department'] = 'ss';

    $reflection = new ReflectionObject(self::$jobsController);
    $method = $reflection->getMethod('getFilters');
    $method->setAccessible(true);
    
    $filters = $method->invoke(self::$jobsController);

    self::assertEquals([
      'location' => '',
      'department' => 'ss'
    ], $filters);
  }

  public function testGetAllJobs() {
    $expectedJobs = array_map(function($job) { return $job->__toArray(); }, [
      new JobModel(1, 'Junior Developer', 'Berlin', 'Tech', 'Part Time'),
      new JobModel(2, 'Senior Developer', 'Berlin', 'Tech', 'Full Time')
    ]);

    $_GET['location'] = 'berlin';
    $jobs = self::$jobsController->index();

    self::assertEquals(print(json_encode($expectedJobs, true)), $jobs);
  }
} 

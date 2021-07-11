<?php

use PHPUnit\Framework\TestCase;
use App\Models\Resource\Job;
use App\Models\Job as JobObj;

class ResourceJobTest extends TestCase {
    /**
   * @var Job $router
   */
  protected static $job;

  public function setUp(): void {
    self::$job = new Job();
  }

  public function testClassCreated() {
    self::assertInstanceOf(Job::Class, self::$job);
  }

  public function testGetAllJobs() {
    $jobs = self::$job->getAll();
    $jobIds = array_map(function($job) {
      return $job->getId();
    }, self::$job->getAll());

    self::assertEquals(7, count($jobs));
    self::assertEquals([1, 2, 3, 4, 5, 6, 7], $jobIds);

    foreach ($jobs as $job) {
      self::assertInstanceOf(JobObj::class, $job);
    }
  }

  public function testGetAllWithLocationFilters() {
    $jobs = self::$job->getAll(['location' => 'berlin']);
    $jobIds = array_map(function($job) { return $job->getId(); }, $jobs);

    self::assertEquals(2, count($jobs));
    self::assertEquals([1, 2], $jobIds);
    foreach ($jobs as $job) {
      self::assertInstanceOf(JobObj::class, $job);
    }
  }

  public function testGetAllWithWrongLocationFilters() {
    $jobs = self::$job->getAll(['location' => 'blabla']);
    $jobIds = array_map(function($job) { return $job->getId(); }, $jobs);

    self::assertEquals(0, count($jobs));
    self::assertEquals([], $jobIds);
  }

  public function testGetAllWithDepartmentFilters() {
    $jobs = self::$job->getAll(['department' => 'hr']);
    $jobIds = array_values(array_map(function($job) { return $job->getId(); }, $jobs));

    self::assertEquals(1, count($jobs));
    self::assertEquals([3], $jobIds);
    foreach ($jobs as $job) {
      self::assertInstanceOf(JobObj::class, $job);
    }
  }

  public function testGetAllWithTypeFilters() {
    $jobs = self::$job->getAll(['type' => 'full time']);
    $jobIds = array_values(array_map(function($job) { return $job->getId(); }, $jobs));

    self::assertEquals(4, count($jobs));
    self::assertEquals([2, 3, 4, 7], $jobIds);
    foreach ($jobs as $job) {
      self::assertInstanceOf(JobObj::class, $job);
    }
  }

  /**
   * @expectedException \Exception
   */
  public function testGetAllWithUnallowedFilter() {
    try {
      $jobs = self::$job->getAll(['title' => 'bla bla bla']);
    } catch (\Exception $e) {
      self::assertEquals($e->getMessage(), 'Requested Field title is not filterable');
    }
  }
}

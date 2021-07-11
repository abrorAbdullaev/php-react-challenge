<?php

use PHPUnit\Framework\TestCase;
use App\Models\Job;

class JobTest extends TestCase {
  /**
   * @var Job $router
   */
  protected static $job;

  public function setUp(): void {
    self::$job = new Job(1, 'testTitle', 'testLocation', 'testDepartment', 'testType');
  }

  public function testClassCreated() {
    self::assertInstanceOf(Job::Class, self::$job);
  }

  public function testClassProps() {
    $id = self::$job->getId();
    $title = self::$job->getTitle();
    $location = self::$job->getLocation();
    $department = self::$job->getDepartment();
    $type = self::$job->getType();

    self::assertEquals($id, 1);
    self::assertEquals($title, 'testTitle');
    self::assertEquals($location, 'testLocation');
    self::assertEquals($department, 'testDepartment');
    self::assertEquals($type, 'testType');
  }

  public function testClassSetProps() {
    self::$job->setTitle('newTitle');
    self::$job->setLocation('newLocation');
    self::$job->setDepartment('newDepartment');
    self::$job->setType('newType');

    self::assertEquals(self::$job->getTitle(), 'newTitle');
    self::assertEquals(self::$job->getLocation(), 'newLocation');
    self::assertEquals(self::$job->getDepartment(), 'newDepartment');
    self::assertEquals(self::$job->getType(), 'newType');
  }
  public function testToArray() {
    $array = self::$job->__toArray();

    self::assertEquals($array, [
      'id' => 1,
      'title' => 'testTitle',
      'location' => 'testLocation',
      'department' => 'testDepartment',
      'type' => 'testType'
    ]);
  }
}

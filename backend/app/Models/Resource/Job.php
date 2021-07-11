<?php

namespace App\Models\Resource;

use \App\Models\Job as JobModel;

/**
 * Resource Model For Object Job
 * Good Idea should be to use a singletone object as long as I use the class as a storage of the data too
 */
class Job {
  /**
   * @var Array<Job> $jobs
   */
  protected $jobs = Array();

  /**
   * Only these fields can be used for filtering
   */
  public static $filterableProps = [ 'location', 'department', 'type' ];

  /**
   * Good way should have been to use the database connection, and real data exchange
   * but as it is a standart procedure and moreover I would be using library anyway like maybe Doctrine.
   * For the time sake I will be using the mock data
   */
  public function __construct() {
    $this->jobs = [
      new JobModel(1, 'Junior Developer', 'Berlin', 'Tech', 'Part Time'),
      new JobModel(2, 'Senior Developer', 'Berlin', 'Tech', 'Full Time'),
      new JobModel(3, 'Senior HR Manager', 'Hamburg', 'HR', 'Full Time'),
      new JobModel(4, 'Senior Product Manager', 'Hamburg', 'Product', 'Full Time'),
      new JobModel(5, 'Project Manager', 'Hannover', 'Tech', 'Part Time'),
      new JobModel(6, 'The Ruler Of The World', 'Moon', 'Gods', 'Eternitiy'), // Easter Egg, you found it woohoo!
      new JobModel(7, 'The Lord Of The Rings', 'Mordor', 'Orc Tribes', 'Full Time')
    ];
  }

  /**
   * @return array
   */
  public function getAll($filters = []) {
    // Validate filerable field
    if (count($filters) > 0) {
      foreach ($filters as $filterField => $filterValue) {
        if (!in_array($filterField, self::$filterableProps)) {
          throw new \Exception('Requested Field ' . $filterField . ' is not filterable');
        }
      }
    }

    $result = $this->jobs;

    if ($filters) {
      foreach ($filters as $key => $filter) {
        $result = array_filter($result, function($job) use($key, $filter) {
          return strpos(strToLower(call_user_func(array($job, 'get' . ucfirst($key)))), strToLower($filter)) > -1;
        });
      }
    }

    return $result;
  }
}

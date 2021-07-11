<?php

namespace App\Models;

class Job {
  protected $id;
  protected $title;
  protected $location;
  protected $department;
  protected $type;

  public function __construct(
    $id,
    $title,
    $location,
    $department,
    $type
  ) {
    $this->id = $id;
    $this->title = $title;
    $this->location = $location;
    $this->department = $department;
    $this->type = $type;
  }

  // Should be located in abstract model class and automated based on self properties
  public function __toArray() {
    return [
      'id' => $this->id,
      'title' => $this->title,
      'location' => $this->location,
      'department' => $this->department,
      'type' => $this->type
    ];
  }

  // Better would be to use magic get and set methods in combination with core abstract model
  public function getId() { return $this->id; }
  public function getTitle() { return $this->title; }
  public function getLocation() { return $this->location; }
  public function getDepartment() { return $this->department; }
  public function getType() { return $this->type; }

  public function setTitle($title) { $this->title = $title; return $this; }
  public function setLocation($location) { $this->location = $location; return $this; }
  public function setDepartment($department) { $this->department = $department; return $this; }
  public function setType($type) { $this->type = $type; return $this; }
}

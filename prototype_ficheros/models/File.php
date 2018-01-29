<?php
  class File {
    public $id;
    public $parent_id;
    public $created;
    public $name;

    public function __construct($id, $parent_id, $name, $created) {
      $this->id      = $id;
      $this->parent_id = $parent_id;
      $this->created  = $created;
      $this->name = $name;
    }
  }
?>
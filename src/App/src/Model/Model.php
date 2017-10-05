<?php

namespace App\Model;

use Zend\Db\Adapter\Adapter;

class Model
{

  protected $db;

  public function __construct(Adapter $db)
  {
    $this->db = $db;
  }

}
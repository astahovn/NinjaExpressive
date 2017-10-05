<?php

namespace App\Model;

class Post
{

  protected $db;

  public function __construct($db)
  {
    $this->db = $db;
  }

  public function fetchPosts()
  {
    $statement = $this->db->query('select * from posts order by id;');
    return $statement->execute();
  }

}
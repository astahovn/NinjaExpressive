<?php

namespace App\Model;

class Post extends Model
{

  public function fetchLast()
  {
    $statement = $this->db->query('select id, title, short_text from posts order by id limit 3;');
    return $statement->execute();
  }

}
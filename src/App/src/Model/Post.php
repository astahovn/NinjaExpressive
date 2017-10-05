<?php

namespace App\Model;

class Post extends Model
{

  public function fetchPosts()
  {
    $statement = $this->db->query('select id, title, short_text from posts order by id;');
    return $statement->execute();
  }

}
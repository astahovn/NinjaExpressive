<?php

namespace App\Model;

use Zend\Db\Sql\Sql;

class Post extends Model
{

  public function fetchLast()
  {
    $sql = new Sql($this->db);
    $select = $sql->select();
    $select
        ->from('posts')
        ->columns(['id', 'title', 'short_text'])
        ->order('id')
        ->limit(3);

    $statement = $sql->prepareStatementForSqlObject($select);
    return $statement->execute();
  }

}
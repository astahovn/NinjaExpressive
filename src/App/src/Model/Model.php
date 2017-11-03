<?php

namespace App\Model;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class Model
{
    /** @var EntityManager */
    protected $em;

    /** @var EntityRepository */
    protected $rep;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

}
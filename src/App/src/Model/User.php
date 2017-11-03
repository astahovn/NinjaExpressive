<?php

namespace App\Model;

use Doctrine\ORM\EntityManager;
use App\Entity\User as UserEntity;

class User extends Model
{

    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager);

        $this->rep = $this->em->getRepository(UserEntity::class);
    }

    /**
     * New user registration
     * @param string $username
     * @param string $password
     * @return boolean|string
     */
    public function register($username, $password)
    {
        if ($this->rep->findOneByUsername($username)) {
            return 'Login is busy';
        }

        $user = new UserEntity();
        $user->setUsername($username);
        $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
        $this->em->persist($user);
        $this->em->flush();
        return true;
    }

    /**
     * @param string $username
     * @return UserEntity
     */
    public function findByUsername($username)
    {
        return $this->rep->findOneByUsername($username);
    }

}
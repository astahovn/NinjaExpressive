<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 **/
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(name="username", type="string", length=255)
     * @var string
     */
    private $username;

    /**
     * @ORM\Column(name="password", type="string", length=255)
     * @var string
     */
    private $password;

    /**
     * @ORM\Column(name="nick", type="string", length=255)
     * @var string
     */
    private $nick;

    public function getId()
    {
        return $this->id;
    }

    public function getNick()
    {
        return $this->nick;
    }

    public function setNick($nick)
    {
        $this->nick = $nick;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

}
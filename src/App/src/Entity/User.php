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

    /**
     * @ORM\Column(name="open_key", type="string")
     * @var string
     */
    private $open_key;

    /**
     * @ORM\Column(name="private_key_check", type="string")
     * @var string
     */
    private $private_key_check;

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

    public function getOpenKey()
    {
        return $this->open_key;
    }

    public function setOpenKey($openKey)
    {
        $this->open_key = trim($openKey);
    }

    public function getPrivateKeyCheck()
    {
        return $this->private_key_check;
    }

    public function setPrivateKeyCheck($privateKeyCheck)
    {
        $this->private_key_check = trim($privateKeyCheck);
    }
}
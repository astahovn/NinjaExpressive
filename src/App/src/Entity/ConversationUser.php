<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Conversation;

/**
 * @ORM\Entity
 * @ORM\Table(name="conversation_users")
 **/
class ConversationUser
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(name="conversation_id", type="integer")
     * @var int
     */
    protected $conversation_id;

    /**
     * @ORM\Column(name="user_id", type="integer")
     * @var int
     */
    protected $user_id;

    /**
     * @ORM\Column(name="key", type="string", length=255)
     * @var string
     */
    protected $key;

    /** @ORM\ManyToOne(targetEntity="Conversation") */
    protected $conversation;

    public function getId()
    {
        return $this->id;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function setKey($key)
    {
        $this->key = $key;
    }

    public function getConversationId()
    {
        return $this->conversation_id;
    }

    public function setConversationId($conversation_id)
    {
        $this->conversation_id = $conversation_id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return \App\Entity\Conversation
     */
    public function getConversation()
    {
        return $this->conversation;
    }

}
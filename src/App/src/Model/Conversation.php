<?php

namespace App\Model;

use Doctrine\ORM\EntityManager;
use App\Entity\Conversation as ConversationEntity;
use App\Entity\ConversationUser as ConversationUserEntity;

class Conversation extends Model
{

    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager);

        $this->rep = $this->em->getRepository(ConversationEntity::class);
    }

    /**
     * Create new conversation
     * @param string $theme  Conversation theme.
     * @param string $key    User key.
     * @param int    $userId User id.
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create(string $theme, string $key, int $userId)
    {
        // Create conversation
        $conversation = new ConversationEntity();
        $conversation->setTheme($theme);
        $this->em->persist($conversation);
        $this->em->flush();

        // Create first user
        $conversationUser = new ConversationUserEntity();
        $conversationUser->setConversationId($conversation->getId());
        $conversationUser->setUserId($userId);
        $conversationUser->setKey($key);
        $this->em->persist($conversationUser);
        $this->em->flush();
    }

}
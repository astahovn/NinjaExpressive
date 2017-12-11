<?php

namespace App\Model;

use App\Entity\ConversationUser;
use Doctrine\ORM\EntityManager;
use App\Entity\Conversation as ConversationEntity;
use App\Entity\ConversationUser as ConversationUserEntity;
use Doctrine\ORM\EntityRepository;

class Conversation extends Model
{
    /** @var EntityRepository */
    protected $repUsers;

    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager);

        $this->rep = $this->em->getRepository(ConversationEntity::class);
        $this->repUsers = $this->em->getRepository(ConversationUserEntity::class);
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

    public function fetchList($userId)
    {
        $result = [];
        /** @var ConversationUser[] $userConversations */
        $userConversations = $this->repUsers->findBy(['user_id' => $userId]);
        foreach ($userConversations as $userConversation) {
            $result[] = [
                'id' => $userConversation->getConversation()->getId(),
                'theme' => $userConversation->getConversation()->getTheme(),
                'key' => $userConversation->getKey()
            ];
        }
        return $result;
    }

}
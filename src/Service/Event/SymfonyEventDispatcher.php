<?php

namespace App\Service\Event;

use App\Entity\User;
use App\Event\UserRegisterEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * UserRegisterEventService.
 *
 * @author Yuriy Filonenko <mail@gmail.com>
 */
class SymfonyEventDispatcher implements DispatcherInterface
{
    private $eventDispatcher;

    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * {@inheritdoc}
     */
    public function registerEvent(User $user): void
    {
        $userRegisterEvent = new UserRegisterEvent($user);

        $this->eventDispatcher->dispatch(
            UserRegisterEvent::NAME,
            $userRegisterEvent
        );
    }
}

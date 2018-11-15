<?php

namespace App\Event;

use App\Mail\WelcomeMessageLetter;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Creates subscriber for UserRegisterEvent.
 *
 * @author Yuriy Filonenko <mail@gmail.com>
 */
class UserSubscriber implements EventSubscriberInterface
{
    private $service;

    public function __construct(WelcomeMessageLetter $service)
    {
        $this->service = $service;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [
            UserRegisterEvent::NAME => 'onUserRegister',
        ];
    }

    /**
     * Send email after user registration.
     *
     * @param UserRegisterEvent $event
     */
    public function onUserRegister(UserRegisterEvent $event): void
    {
        $user = $event->getRegisteredUser();
        $this->service->send($user);
    }
}

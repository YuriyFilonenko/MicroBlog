<?php

namespace App\Event;

use App\Service\MailerServiceInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Subscribe for UserRegisterEvent.
 *
 * @author Yuriy Filonenko <mail@gmail.com>
 */
class UserSubscriber implements EventSubscriberInterface
{
    private $service;

    public function __construct(MailerServiceInterface $service)
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
     * 
     * @return void
     */
    public function onUserRegister(UserRegisterEvent $event): void
    {
        $user = $event->getRegisteredUser();
        $this->service->sendRegistrationEmail($user);
    }
}

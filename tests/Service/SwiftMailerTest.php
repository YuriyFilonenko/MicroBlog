<?php

namespace App\Test\Service;

use App\Service\Mailer\MailerServiceInterface;
use App\Service\Mailer\SwiftMailer;
use PHPUnit\Framework\TestCase;
use Swift_Mailer;
use App\Mail\WelcomeMessageLetter;

/**
 * Test case for SwiftMailer service.
 *
 * @author Yuriy Filonenko <mail@gmail.com>
 */
class SwiftMailerTest extends TestCase
{
    /**
     * {@inheritdoc}
     */
    protected function setUp() 
    {
        $this->service = new SwiftMailer(
            $this->getSwiftMailer(),
            $this->getWelcomeMessageLetter()
        );
    }

    public function testInstanceOfMailerServiceInterface()
    {
        self::assertInstanceOf(MailerServiceInterface::class, $this->service);
    }
    
    public function testSendRegistrationEmail()
    {
        $user = new \App\Entity\User;
        $user->setEmail('user_email@test.com');
        
        $swiftMailer = $this->getSwiftMailer();
        $swiftMailer->expects(self::once())
            ->method('send');
        
        $welcomeMessageLetter = $this->getWelcomeMessageLetter();
        $welcomeMessageLetter->expects(self::once())
                ->method('getWelcomeMessage');
        
        $service = new SwiftMailer($swiftMailer, $welcomeMessageLetter);
        $service->sendEmail($user);
    }
    
    private function getSwiftMailer()
    {
        return $this->getMockBuilder(Swift_Mailer::class)
            ->disableOriginalConstructor()
            ->getMock();
    }
    
    private function getWelcomeMessageLetter()
    {
        return $this->getMockBuilder(WelcomeMessageLetter::class)
            ->disableOriginalConstructor()
            ->getMock();
    }
}

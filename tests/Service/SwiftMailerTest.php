<?php

namespace App\Test\Service;

use App\Service\MailerServiceInterface;
use App\Service\SwiftMailer;
use PHPUnit\Framework\TestCase;
use Swift_Mailer;
use Twig_Environment;

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
            $this->getTwig(),
            'microblog@test.com'
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
        
        $twig = $this->getTwig();
        $twig->expects(self::once())
            ->method('render')
            ->with('email/registration.html.twig', ['user' => $user]);
        
        $service = new SwiftMailer($swiftMailer, $twig, 'microblog@test.com');
        $service->sendRegistrationEmail($user);
    }
    
    private function getSwiftMailer()
    {
        return $this->getMockBuilder(Swift_Mailer::class)
            ->disableOriginalConstructor()
            ->getMock();
    }
    
    private function getTwig()
    {
        return $this->getMockBuilder(Twig_Environment::class)
            ->disableOriginalConstructor()
            ->getMock();
    }
}

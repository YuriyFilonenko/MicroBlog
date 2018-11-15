<?php

namespace App\Test\Service;

use App\Service\Mailer\MailerServiceInterface;
use App\Service\Mailer\SwiftMailer;
use PHPUnit\Framework\TestCase;
use Swift_Mailer;

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
            $this->getSwiftMailer()
        );
    }

    public function testInstanceOfMailerServiceInterface()
    {
        self::assertInstanceOf(MailerServiceInterface::class, $this->service);
    }
    
    public function testSendMessage()
    {
        $message = new \Swift_Message;
        
        $swiftMailer = $this->getSwiftMailer();
        $swiftMailer->expects(self::once())
            ->method('send')
            ->with($message);
        
        $service = new SwiftMailer($swiftMailer);
        $service->sendMessage($message);
    }
    
    private function getSwiftMailer()
    {
        return $this->getMockBuilder(Swift_Mailer::class)
            ->disableOriginalConstructor()
            ->getMock();
    }
}

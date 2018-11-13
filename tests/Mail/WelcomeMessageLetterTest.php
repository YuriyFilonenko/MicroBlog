<?php

namespace App\Test\Mail;

use App\Mail\WelcomeMessageLetter;
use PHPUnit\Framework\TestCase;
use Twig_Environment;

/**
 * Test case for WelcomeMessageLetter
 *
 * @author Yuriy Filonenko <mail@gmail.com>
 */
class WelcomeMessageLetterTest extends TestCase
{
    /**
     * {@inheritdoc}
     */
    protected function setUp() 
    {
        $this->service = new WelcomeMessageLetter(
            $this->getTwig(),
            'microblog@test.com'
        );
    }
    
    public function testGetWelcomeMessage()
    {
        $user = new \App\Entity\User;
        $user->setEmail('user_email@test.com');
        
        $twig = $this->getTwig();
        $twig->expects(self::once())
            ->method('render')
            ->with('email/registration.html.twig', ['user' => $user]);
        
        $service = new WelcomeMessageLetter($twig, 'microblog@test.com');
        $service->getWelcomeMessage($user);
    }
    
    private function getTwig()
    {
        return $this->getMockBuilder(Twig_Environment::class)
            ->disableOriginalConstructor()
            ->getMock();
    }
}

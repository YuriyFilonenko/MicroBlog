<?php

namespace App\Test\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Repository\UserRepositoryInterface;
use App\Service\MySqlRegister;
use App\Service\RegisterServiceInterface;
use PHPUnit\Framework\TestCase;

/**
 * Test case for MySqlRegister service.
 *
 * @author Yuriy Filonenko <mail@gmail.com>
 */
class MySqlRegisterTest extends TestCase
{
    public function testInstanceOfRegisterServiceInterface()
    {
        self::assertInstanceOf(
            RegisterServiceInterface::class,
            new MySqlRegister($this->getUserRepository()
        ));
    }
    
    public function testRegisterUser()
    {
        $userRepository = $this->getUserRepository();
        
        $user = new User();
        
        $userRepository->expects(self::once())
            ->method('addUser')
            ->willReturn($addedUsers[] = $user)
        ;
        
        $service = new MySqlRegister($userRepository);
        
        $actual = $service->registerUser($user);
        
        self::assertContains($user, $addedUsers);
    }
    
    private function getUserRepository(): UserRepositoryInterface
    {
        return $this->getMockBuilder(UserRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
    }
}

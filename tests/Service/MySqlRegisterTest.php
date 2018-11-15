<?php

namespace App\Test\Service;

use App\Dto\UserDto;
use App\Dto\UserDtoToUser;
use App\Repository\UserRepository;
use App\Repository\UserRepositoryInterface;
use App\Service\Event\DispatcherInterface;
use App\Service\Event\SymfonyEventDispatcher;
use App\Service\PasswordEncoder\PasswordEncoderInterface;
use App\Service\PasswordEncoder\SymfonyPasswordEncoder;
use App\Service\Register\MySqlRegister;
use App\Service\Register\RegisterServiceInterface;
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
            new MySqlRegister(
                $this->getUserRepository(),
                $this->getPassvord(),
                $this->getEvent(),
                $this->getUser()
        ));
    }
    
    public function testRegisterUser()
    {
        $userDto = new UserDto();
        
        $userRepository = $this->getUserRepository();
        $userRepository->expects(self::once())
            ->method('addUser')
            ->willReturn($addedUsers[] = $userDto)
        ;
        
        $password = $this->getPassvord();
        $password->expects(self::once())
            ->method('encode')
        ;
        
        $event = $this->getEvent();
        $event->expects(self::once())
            ->method('registerEvent')
        ;
        
        $user = $this->getUser();
        $user->expects(self::once())
            ->method('createUser')
        ;
        
        $service = new MySqlRegister($userRepository, $password, $event, $user);
        
        $actual = $service->registerUser($userDto);
        
        self::assertContains($userDto, $addedUsers);
    }
    
    private function getUserRepository(): UserRepositoryInterface
    {
        return $this->getMockBuilder(UserRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
    }
    
    private function getPassvord(): PasswordEncoderInterface
    {
        return $this->getMockBuilder(SymfonyPasswordEncoder::class)
            ->disableOriginalConstructor()
            ->getMock();
    }
    
    private function getEvent(): DispatcherInterface
    {
        return $this->getMockBuilder(SymfonyEventDispatcher::class)
            ->disableOriginalConstructor()
            ->getMock();
    }
    
    private function getUser(): UserDtoToUser
    {
        return $this->getMockBuilder(UserDtoToUser::class)
            ->disableOriginalConstructor()
            ->getMock();
    }
}

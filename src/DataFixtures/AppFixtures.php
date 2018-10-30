<?php

namespace App\DataFixtures;

use App\Entity\MicroPost;
use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Provides fake data and load it to database.
 *
 * @author Yuriy Filonenko <mail@gmail.com>
 */
class AppFixtures extends Fixture
{
    private $passwordEncoder;
    
    public function __construct(UserPasswordEncoderInterface $passwordEncoder) 
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $this->loadUsers($manager);
        //$this->loadMicroPosts($manager);
    }
    
    public function loadMicroPosts(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; ++$i) {
            $microPost = new MicroPost();
            $microPost
                ->setMicroPost($faker->text(150))
                ->setCreatedAt(new DateTime())
                ->setUpdatedAt(new DateTime())
            ;
            
            $manager->persist($microPost);
        }

        $manager->flush();
    }
    
    public function loadUsers(ObjectManager $manager)
    {
        $faker = Factory::create();
        
        $user = new User;
        $user
            ->setUsername('Tom')
            ->setFullName('Tom Cat')
            ->setEmail($faker->email)
            ->setPassword($this->passwordEncoder->encodePassword($user, 'pass123')
        );
        
        $manager->persist($user);
        $manager->flush();
    }
}

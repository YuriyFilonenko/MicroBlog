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
        $this->loadMicroPosts($manager);
    }

    public function loadMicroPosts(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < 5; ++$i) {
            $microPost = new MicroPost();
            $microPost
                ->setMicroPost($faker->text(150))
                ->setCreatedAt(new DateTime())
                ->setUpdatedAt(new DateTime())
                ->setUser($this->getReference('User1'))
            ;

            $manager->persist($microPost);
        }

        $manager->flush();
    }

    public function loadUsers(ObjectManager $manager)
    {
        $faker = Factory::create();

        $user = new User();
        $user
            ->setUsername('User1')
            ->setFullName('User One')
            ->setEmail($faker->email)
            ->setPassword($this->passwordEncoder->encodePassword($user, '111111')
        );

        $this->addReference('User1', $user);

        $manager->persist($user);
        $manager->flush();
    }
}

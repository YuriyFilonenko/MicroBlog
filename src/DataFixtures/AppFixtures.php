<?php

namespace App\DataFixtures;

use App\Entity\MicroPost;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

/**
 * Provides fake data and load it to database.
 *
 * @author Yuriy Filonenko <mail@gmail.com>
 */
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; ++$i) {
            $microPost = new MicroPost();
            $microPost->setMicroPost($faker->text(150));
            $microPost->setCreatedAt(new \DateTime());
            $manager->persist($microPost);
        }

        $manager->flush();
    }
}

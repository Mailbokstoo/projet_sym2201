<?php

namespace App\DataFixtures;

use App\Entity\Posts;
use App\Entity\Team;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

;

class AppFixtures extends Fixture
{
    private $passwordHasher;
    private $faker;

    public function __construct(
        UserPasswordHasherInterface $passwordHasher
    )
    {
        $this->passwordHasher = $passwordHasher;
        $this->faker = Factory::create('fr_FR');
    }
    
    public function load(ObjectManager $manager): void
    {
        for($i=1; $i<=6; $i++) {
            $posts[$i] = new Posts;
            $posts[$i]->setTitle($this->faker->title());
            $posts[$i]->setContent($this->faker->content());
            $posts[$i]->setPicture($this->faker->picture());
            $posts[$i]->setPicture(random_int(0, 2));
            $manager->persist($posts[$i]);
        }
        
        $manager->flush();
    }
}
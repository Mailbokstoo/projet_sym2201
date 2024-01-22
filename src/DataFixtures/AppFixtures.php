<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Team;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

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
        $team = new Team;
        $team->setEmail('admintest1@gmail.fr');
        $hashedPassword = $this->passwordHasher->hashPassword(
            $team,
            'pass'
        );
        $team->setPassword($hashedPassword);
        $team->setRoles(['ROLE_SUPER_ADMIN']);
        $team->setFirstname('Admintest');
        $team->setLastname('Un');
        $manager->persist($team);

        $manager->flush();

        for($i=1; $i<=3; $i++) {
            $user[$i] = new User;
            $user[$i]->setEmail('usertest' . $i . '@gmail.com');
            $user[$i]->setFirstname($this->faker->firstname());
            $user[$i]->setLastname($this->faker->lastname());
            $hashedPassword = $this->passwordHasher->hashPassword($user[$i], 'pass');
            $user[$i]->setPassword($hashedPassword);
            $roles = ['ROLE_IDENTIFIED'];
            $role = array_rand(array_flip($roles), 1);
            $user[$i]->setRoles([$role]);
            $manager->persist($user[$i]);
        }
        
        $manager->flush();
    }
}
<?php

namespace App\DataFixtures;

use App\Entity\Backend;
use App\Entity\Frontend;
use App\Entity\Project;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function __construct(
        readonly private UserPasswordHasherInterface $hasher
    )
    {
        
    }
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $front_ends = [];
        $back_ends = [];
        $user = new User();
        $user->setEmail('admin@admin.com')
            ->setPassword($this->hasher->hashPassword($user, 'azerty'))
            ->setRoles(['ROLE_ADMIN'])
            ;
        $manager->persist($user);

        for ($i=0; $i < 10; $i++) { 
            $front_end = new Frontend();
            $front_end->setName($faker->randomElement(['tailwind', 'bootstrap', 'javaScrip', 'Vue js', 'React js']))
                ->setIcon($faker->imageUrl)
            ;
            $manager->persist($front_end);
            $front_ends[] = $front_end;
        }
        for ($i=0; $i < 10; $i++) { 
            $back_end = new Backend();
            $back_end->setName($faker->randomElement(['symfony', 'express js', 'laravel', 'Wordpress', 'flask', 'Docker']))
                ->setIcon($faker->imageUrl)
            ;
            $manager->persist($back_end);
            $back_ends[] = $$back_end;
        }
        for ($i=0; $i < 10; $i++) { 
            $project = new Project();
            $project->setName($faker->randomElement(['symfony', 'express js', 'laravel', 'Wordpress', 'flask', 'Docker']))
                ->setUrl($faker->url)
                ->setImage($faker->imageUrl)
            ;
            for ($j=0; $j < 2; $j++) { 
                $project->addFrontend($faker->randomElement($front_ends));
            }
            for ($j=0; $j < 2; $j++) { 
                $project->addBackend($faker->randomElement($back_ends));
            }
            $manager->persist($project);
        }

        $manager->flush();
    }
}
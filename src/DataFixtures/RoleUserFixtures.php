<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class RoleUserFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $roleUsers = [
            [
                'user_email' => 'jane.doe@example.com',
                'role' => 'admin'
            ],
            [
                'user_email' => 'max.mueller@example.com',
                'role' => 'membre'
            ],
            [
                'user_email' => 'sarah.johnson@example.com',
                'role' => 'affilié'
            ],
            [
                'user_email' => 'antoine.dubois@example.com',
                'role' => 'membre'
            ],
        ];

        foreach ($roleUsers as $record) {
            //Récupérer le user (entité principale)
            $user = $this->getReference($record['user_email']);
            
            //Récupérer le role (entité secondaire)
            $role = $this->getReference($record['role']);
            
            //Définir son role
            $user->addRole($role);
            
            //Persister l'entité principale
            $manager->persist($user);            
        }

        $manager->flush();
    }
    
    public function getDependencies() {
        return [
            UserFixtures::class,
            RoleFixtures::class,
        ];
    }

}

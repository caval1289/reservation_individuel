<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Role;

class RoleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $roles = [
            ['role'=>'admin'],
            ['role'=>'membre'],
            ['role'=>'affilié'],
        ];
        
        foreach ($roles as $record) {
            $role = new Role();
            $role->setRole($record['role']);
            
            $manager->persist($role);
        }

        $manager->flush();
    }
}

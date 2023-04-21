<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $users = [
            [
                'login' => 'jane',
                'password' => 'p@ssw0rd',
                'firstname' => 'Jane',
                'lastname' => 'Doe',
                'email' => 'jane.doe@example.com',
                'langue' => 'en',
                'created_at' => date_create_immutable('2023-04-21'),
                'updated_at' => date_create_immutable('2023-04-21'),
                'email_verified_at' => date_create_immutable('2023-04-21'),
                'remember_token'=>'f07cb87f16bdc89f1d0e9cc9dd00e484d81bdf1911b2dc1b2fcd5fb09b5d5a'
            ],
            [
                'login' => 'max',
                'password' => 'g0ld3np@ss',
                'firstname' => 'Max',
                'lastname' => 'Müller',
                'email' => 'max.mueller@example.com',
                'langue' => 'fr',
                'created_at' => date_create_immutable('2023-04-21'),
                'updated_at' => date_create_immutable('2023-04-21'),
                'email_verified_at' => date_create_immutable('2023-04-21'),
                'remember_token'=>'a8c1b7f1a930d8437d2c0808f695a79d2c01e425b75e3c95a3e32c579528b1'
            ],
            [
                'login' => 'sarah',
                'password' => 'c0mpl3xP@ss',
                'firstname' => 'Sarah',
                'lastname' => 'Johnson',
                'email' => 'sarah.johnson@example.com',
                'langue' => 'en',
                'created_at' => date_create_immutable('2023-04-21'),
                'updated_at' => date_create_immutable('2023-04-21'),
                'email_verified_at' => date_create_immutable('2023-04-21'),
                'remember_token'=>'d203c8241728bc03590bf73dbb33f343b853f01e8a40da22ab2bae9d9f92e3f'
            ],
            [
                'login' => 'antoine',
                'password' => 'p@ssw0rd!',
                'firstname' => 'Antoine',
                'lastname' => 'Dubois',
                'email' => 'antoine.dubois@example.com',
                'langue' => 'fr',
                'created_at' => date_create_immutable('2023-04-21'),
                'updated_at' => date_create_immutable('2023-04-21'),
                'email_verified_at' => date_create_immutable('2023-04-21'),
                'remember_token'=>'3b72fc352f66fcfdbad4c2e4e4b4a35c0d9b9b76f8ebf5e193a7a6d01c87d23'
            ],
        ];

        foreach ($users as $record) {
            $user = new User();
            $user->setLogin($record['login']);
            $user->setPassword($record['password']);
            $user->setFirstname($record['firstname']);
            $user->setLastname($record['lastname']);
            $user->setEmail($record['email']);
            $user->setLangue($record['langue']);
            $user->setCreatedAt($record['created_at']);
            $user->setUpdatedAt($record['updated_at']);
            $user->setEmailVerifiedAt($record['email_verified_at']);
            $user->setRememberToken($record['remember_token']);
            $manager->persist($user);
            $this->addReference($record['email'], $user);
        }

        $manager->flush();
    }
}

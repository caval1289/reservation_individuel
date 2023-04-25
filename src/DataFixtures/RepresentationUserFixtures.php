<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\RepresentationUser;

class RepresentationUserFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $representationUsers = [
            [
                'email' => 'jane.doe@example.com',
                'schedule' => '2012-10-12 13:30',
                'places' => 2
            ],
            [
                'email' => 'max.mueller@example.com',
                'schedule' =>  '2012-10-12 20:30',
                'places' => 4
            ],
            [
                'email' => 'sarah.johnson@example.com',
                'schedule' => '2012-10-02 20:30',
                'places' => 3
            ],
            [
                'email' => 'antoine.dubois@example.com',
                'schedule' =>  '2012-10-16 20:30',
                'places' => 12
            ],
        ];

        foreach ($representationUsers as $record) {
            if ($record['email']) {
                //Récupérer le user (entité principale)
                $user = $this->getReference($record['email']);
            }
            $schedule = \DateTime::createFromFormat('Y-m-d H:i', $record['schedule']);
            $representation = $this->getReference($record['schedule']);

            $at = new RepresentationUser();
            $at->setUser($user);
            $at->setRepresentation($representation);
            $at->SetPlaces($record['places']);
            $this->setReference($record['email'], $at);
            $this->setReference($record['schedule'], $at);
            $this->addReference($record['places'], $at);

            $manager->persist($at);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            RepresentationFixtures::class,
        ];
    }
}

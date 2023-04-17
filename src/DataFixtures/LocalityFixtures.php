<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Locality;

class LocalityFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $localitys = [
            ['postal_code'=>'1000','locality'=>'Bruxelles'],
            ['postal_code'=>'1020','locality'=>'Laeken'],
            ['postal_code'=>'1030','locality'=>'Schaerbeek'],
            ['postal_code'=>'1040','locality'=>'Etterbeek'],
            ['postal_code'=>'1050','locality'=>'Ixelles'],
            ['postal_code'=>'1060','locality'=>'Saint-Gilles'],
            ['postal_code'=>'1070','locality'=>'Anderlecht'],
            ['postal_code'=>'1080','locality'=>'Molenbeek-Saint-Jean'],
            ['postal_code'=>'1081','locality'=>'Koekelberg'],
            ['postal_code'=>'1082','locality'=>'Berchem-Sainte-Agathe'],
            ['postal_code'=>'1083','locality'=>'Ganshoren'],
            ['postal_code'=>'1090','locality'=>'Jette'],
            ['postal_code'=>'1200','locality'=>'Woluwe-Saint-Lambert']
        ];
        
        foreach ($localitys as $record) {
            $locality = new locality();
            $locality->setPostalCode($record['postal_code']);
            $locality->setLocality($record['locality']);
            $manager->persist($locality);

            $this->addReference($record['locality'], $locality);
        }

        $manager->flush();
    }
}

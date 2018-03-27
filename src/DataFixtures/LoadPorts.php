<?php

namespace App\DataFixtures;

use App\Entity\Port;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;



class LoadPorts extends Fixture
{



    public function load(ObjectManager $manager)
    {

            $port1 = new port();
            $port1->setId('port ' . '1');
            $port1->setPortName('Porto cruz LBV ' );
            $port1->setPriceRange(mt_rand(10, 100));
            $port1->setIngredients('Berries ');
            $port1->setPhoto('p1.png');
            $port1->setDescription('Ah lovely port with nodes of berries and a summer day');
            $port1->setReviewedBy('ken');


            $port2 = new port();
            $port2->setId('port ' . '1');
            $port2->setPortName('Tesco finest LBV' );
            $port2->setPriceRange(mt_rand(10, 100));
            $port2->setIngredients('Berries ');
            $port2->setPhoto('p2.jpg');
            $port2->setDescription('Cold winter Port to warm your heart');
            $port2->setReviewedBy('ken');

            $manager->persist($port1);
            $manager->persist($port2);

        $manager->flush();
    }
}

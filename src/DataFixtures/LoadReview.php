<?php


namespace App\DataFixtures;

use App\Entity\Review;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;



class LoadReview extends Fixture
{



            public function load(ObjectManager $manager)
            {

                $review1 = new review();
              $review1->setId('1');
                $review1->setReview('This taste like a dream ');
                $review1->setPlaceOfPurchase('Porto');
                $review1->setPricePaid('9.99');
                $review1->setNumOfStars('2.5');
                $review1->setUser('ken');
                $review1->setDate ();

                $review1->setIsPublic('true');



                $manager->persist($review1);



                $manager->flush();

            }
}

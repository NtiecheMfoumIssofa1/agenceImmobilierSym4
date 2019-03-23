<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class PropertyFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {


        #remplissage dynamique de la bd avec fixture
        $faker = Factory::create('fr_FR');
            for ($i = 0; $i< 100; $i++ ){
            $property = new Property();
                $property
                         ->setTitle($faker->words(3,true))
                         ->setDescription($faker->sentences(3,true))
                         ->setPrice($faker->numberBetween(100000, 10000000))
                         ->setRooms($faker->numberBetween(2,10))
                         ->setBedrooms($faker->numberBetween(1,9))
                         ->setSurface($faker->numberBetween(20,350))
                         ->setFloor($faker->numberBetween(0,15))
                         ->setHeat($faker->numberBetween(0, count(Property::HEAT) -1))
                         ->setCity($faker->city)
                         ->setAddress($faker->address)
                         ->setPostalCode($faker->postcode)
                         ->setSold(false);
                $manager->persist($property);

            }

        $manager->flush();
    }
}

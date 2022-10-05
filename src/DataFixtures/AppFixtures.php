<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Product;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {        
        $faker = Factory::create('fr_FR');

        $category1 = new Category();
        $category1->setTitle("category1");
        $category2 = new Category();
        $category2->setTitle("category2");
        $category3 = new Category();
        $category3->setTitle("category3");
        $manager->persist($category1);
        $manager->persist($category2);
        $manager->persist($category3);
        $tabCategory = [$category1, $category2, $category3] ;

        for($x = 0; $x < 30; $x++){
            $product = new Product();
            $product->setTitle($faker->name())
            ->setPrice($faker->randomNumber(2))
            ->setDescription($faker->realText($maxNbChars = 200))
            ->setCategory($tabCategory[mt_rand(0,2)]);
            $manager->persist($product);
        }

        $manager->flush();


        
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}

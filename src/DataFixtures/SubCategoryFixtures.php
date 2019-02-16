<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Category;
use App\DataFixtures\GeneralCategoryFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;



class SubCategoryFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        //create sub category

        $category9 = new Category();
        $category9->setName('Car');
        $category9->setParent($this->getReference('Vehicles'));

        $manager->persist($category9);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            GeneralCategoryFixtures::class,
        ];
    }
}

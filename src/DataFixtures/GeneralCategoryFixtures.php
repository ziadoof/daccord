<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Ads\Category;



class GeneralCategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //create main category
        $general = ['Vehicles','Jobs and services','Media','Information','Fashion','Home appliances',
            'Agriculture and gardens','Residence','Jewelry and accessories','Music','Sport','Pets','Kids','Furniture and decorations','Holidays'];

        $this->addGeneralCategory($general,$manager);

    }

    public function addGeneralCategory($general,ObjectManager $manager){
        foreach ($general as $generalCategory ){
            $category = new Category();
            $category->setName($generalCategory);
            $category->setParent(null);
            $category->setType('Offer');
            $this->addReference($generalCategory.'_'.'Offer',$category);
            $manager->persist($category);
        }
        foreach ($general as $generalCategory ){
            $category = new Category();
            $category->setName($generalCategory);
            $category->setParent(null);
            $category->setType('Demand');
            $this->addReference($generalCategory.'_'.'Demand',$category);
            $manager->persist($category);
        }
        foreach ($general as $generalCategory ){
            $category = new Category();
            $category->setName($generalCategory);
            $category->setParent(null);
            $category->setType('SearchOffer');
            $this->addReference($generalCategory.'_'.'SearchOffer',$category);
            $manager->persist($category);
        }
        foreach ($general as $generalCategory ){
            $category = new Category();
            $category->setName($generalCategory);
            $category->setParent(null);
            $category->setType('SearchDemand');
            $this->addReference($generalCategory.'_'.'SearchDemand',$category);
            $manager->persist($category);
        }

        $manager->flush();
    }
}

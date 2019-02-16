<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Category;



class GeneralCategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //create main category
        $category1 = new Category();
        $category1->setName('Vehicles');
        $category1->setParent(null);
        $this->addReference('Vehicles',$category1);

        $manager->persist($category1);

        $category2 = new Category();
        $category2->setName('Jobs');
        $category2->setParent(null);
        $this->addReference('Jobs',$category2);

        $manager->persist($category2);

        $category3 = new Category();
        $category3->setName('Media');
        $category3->setParent(null);
        $this->addReference('Media',$category3);

        $manager->persist($category3);

        $category4 = new Category();
        $category4->setName('Entertainment');
        $category4->setParent(null);
        $this->addReference('Entertainment',$category4);

        $manager->persist($category4);

        $category5 = new Category();
        $category5->setName('Fashion');
        $category5->setParent(null);
        $this->addReference('Fashion',$category5);

        $manager->persist($category5);

        $category6 = new Category();
        $category6->setName('Home Appliances');
        $category6->setParent(null);
        $this->addReference('Home Appliances',$category6);

        $manager->persist($category6);

        $category7 = new Category();
        $category7->setName('Agriculture and gardens');
        $category7->setParent(null);
        $this->addReference('Agriculture and gardens',$category7);

        $manager->persist($category7);

        $category8 = new Category();
        $category8->setName('Housing');
        $category8->setParent(null);
        $this->addReference('Housing',$category8);

        $manager->persist($category8);

        $manager->flush();
    }
}

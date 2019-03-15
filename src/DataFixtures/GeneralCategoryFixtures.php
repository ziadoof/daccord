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
        $category2->setName('Jobs and services');
        $category2->setParent(null);
        $this->addReference('Jobs and services',$category2);

        $manager->persist($category2);

        $category3 = new Category();
        $category3->setName('Media');
        $category3->setParent(null);
        $this->addReference('Media',$category3);

        $manager->persist($category3);

        $category4 = new Category();
        $category4->setName('Information');
        $category4->setParent(null);
        $this->addReference('Information',$category4);

        $manager->persist($category4);

        $category5 = new Category();
        $category5->setName('Fashion');
        $category5->setParent(null);
        $this->addReference('Fashion',$category5);

        $manager->persist($category5);

        $category6 = new Category();
        $category6->setName('Home appliances');
        $category6->setParent(null);
        $this->addReference('Home appliances',$category6);

        $manager->persist($category6);

        $category7 = new Category();
        $category7->setName('Agriculture and gardens');
        $category7->setParent(null);
        $this->addReference('Agriculture and gardens',$category7);

        $manager->persist($category7);

        $category8 = new Category();
        $category8->setName('Residence');
        $category8->setParent(null);
        $this->addReference('Residence',$category8);

        $manager->persist($category8);

        $category9 = new Category();
        $category9->setName('Jewelry and accessories');
        $category9->setParent(null);
        $this->addReference('Jewelry and accessories',$category9);

        $manager->persist($category9);

        $category10 = new Category();
        $category10->setName('Music');
        $category10->setParent(null);
        $this->addReference('Music',$category10);

        $manager->persist($category10);

        $category11 = new Category();
        $category11->setName('Sport');
        $category11->setParent(null);
        $this->addReference('Sport',$category11);

        $manager->persist($category11);

        $category12 = new Category();
        $category12->setName('Pets');
        $category12->setParent(null);
        $this->addReference('Pets',$category12);

        $manager->persist($category12);


        $category14 = new Category();
        $category14->setName('Kids');
        $category14->setParent(null);
        $this->addReference('Kids',$category14);

        $manager->persist($category14);

        $category15 = new Category();
        $category15->setName('Furniture and decorations');
        $category15->setParent(null);
        $this->addReference('Furniture and decorations',$category15);

        $manager->persist($category15);

        $category17 = new Category();
        $category17->setName('Holidays');
        $category17->setParent(null);
        $this->addReference('Holidays',$category17);

        $manager->persist($category17);

        $manager->flush();
    }
}

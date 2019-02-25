<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Category;
use App\DataFixtures\GeneralCategoryFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;



class CategoryFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $vehicles = ['Car','Motors','Caravan','Boat','Agricultural machinery','Car parts','Motor parts','Vehicle accessories','Other'];
        foreach ($vehicles as $vehicle){
            $category = new Category();
            $category->setName($vehicle);
            $category->setParent($this->getReference('Vehicles'));
            $manager->persist($category);
        }
        $jobs = ['Job opportunity','Translation','Mathematics lessons','Music lessons','Language lessons','Language exchange',
                 'House work','Maintenance services','Other'];
        foreach ($jobs as $job){
            $category = new Category();
            $category->setName($job);
            $category->setParent($this->getReference('Jobs and services'));
            $manager->persist($category);
        }

        $medias = ['TV','Monitor','Wolkman','Camera','Audio accessories','Camera accessories',
                   'Headphones','Telephone','Video games','DVD Games','Games accessories','Movies','Books','Other'];
        foreach ($medias as $media){
            $category = new Category();
            $category->setName($media);
            $category->setParent($this->getReference('Media'));
            $manager->persist($category);
        }

        $medias = ['Computer','laptop','Tablet','Mobile','Scanner','Printer',
                   'Monitor','Mouse','keyboard','Speaker','Hard disk','Other'];
        foreach ($medias as $media){
            $category = new Category();
            $category->setName($media);
            $category->setParent($this->getReference('Information'));
            $manager->persist($category);
        }

        $fashions = ['T-shirt','Shirt','Trouser','Short','Costume','Dress',
            'Wedding dress','Jacket','Langerie','Shoe','Slide sandal','Athletic shoe','Other'];
        foreach ($fashions as $fashion){
            $category = new Category();
            $category->setName($fashion);
            $category->setParent($this->getReference('Fashion'));
            $manager->persist($category);
        }

        $homeAppliances = ['Refrigerator','Cookers gas','Cookers electric','Gas plate','Washing machine','Fan','Coffee machine'
                            ,'Electric kettle','Vaccuum cleaner','Oven','Blender','Stand Mixer','Dishwashers','Electric fryer'
                            ,'Freezer','Pressure cooker','Heater','Iron','Men\'s shaver','Lady shavers','Sandwich toaster'
                            ,'Meat grinder','Grilling charcoal','Hair dryer','Juicer machine','Electric vegetable','Kitchen accessories','Other'];
        foreach ($homeAppliances as $homeAppliance){
            $category = new Category();
            $category->setName($homeAppliance);
            $category->setParent($this->getReference('Home appliances'));
            $manager->persist($category);
        }

        $gardens = ['Garden table','Swing','Seedlings','Garden chair','Lawn mower','Chainsaw',
            'Garden tools','Fuelwood','Electric generator','Other'];
        foreach ($gardens as $garden){
            $category = new Category();
            $category->setName($garden);
            $category->setParent($this->getReference('Agriculture and gardens'));
            $manager->persist($category);
        }

        $residences = ['Sell house','Sell apartment','Sell office','Sell shop','Sell car parking','Sell farm',
            'Rent house','Rent apartment','Office rental','Rent  shop','Rent car parking','Rent  farm','Collective housing','Other'];
        foreach ($residences as $residence){
            $category = new Category();
            $category->setName($residence);
            $category->setParent($this->getReference('Residence'));
            $manager->persist($category);
        }
        $jewelrys = ['Necklaces','Collier','Bracelet','Ring','Watch','Earrings',
            'Perfumes','Wine','Other'];
        foreach ($jewelrys as $jewelry){
            $category = new Category();
            $category->setName($jewelry);
            $category->setParent($this->getReference('Jewelry and accessories'));
            $manager->persist($category);
        }

        $musics = ['Piano','Violin','Trumpet','Flute','Clarinet','Drums',
            'Cello','Contrabass','Electric guitar','Classic guitar','Digital keyboard','Accordion','Music accessories','Other'];
        foreach ($musics as $music){
            $category = new Category();
            $category->setName($music);
            $category->setParent($this->getReference('Music'));
            $manager->persist($category);
        }

        $sports = ['Ski boots','Roller skating','Parachute','Swimming glasses','Football','Basketball',
            'Iron balls','Volley ball','American football','Sports tool','Bicycle','Bicycle accessories','Other'];
        foreach ($sports as $sport){
            $category = new Category();
            $category->setName($sport);
            $category->setParent($this->getReference('Sport'));
            $manager->persist($category);
        }

        $Pets = ['Cat','Dog','Hamster','Mouse','Other'];
        foreach ($Pets as $Pet){
            $category = new Category();
            $category->setName($Pet);
            $category->setParent($this->getReference('Pets'));
            $manager->persist($category);
        }

        $kids = ['Crib','Chest of drawers','Stroller','Diapers','Mattress','Baby clothes',
            'Baby tools','Baby toys','Other'];
        foreach ($kids as $kid){
            $category = new Category();
            $category->setName($kid);
            $category->setParent($this->getReference('Kids'));
            $manager->persist($category);
        }

        $furnitures = ['Couch','Dining table','Chest of drawers','Closet','Central table','Bed','Mattress'
            ,'Quilt','Carpet','Chair','Office chair','Sofa','Racks','Study table','Click clack','Nightstand','Shoe cabinet'
            ,'Chandelier','Antic','Painting','Roses','Curtain','Floor lamp','Mirror','Other'];
        foreach ($furnitures as $furniture){
            $category = new Category();
            $category->setName($furniture);
            $category->setParent($this->getReference('Furniture and decorations'));
            $manager->persist($category);
        }

        $holidays = ['Camp','Hotel','Cottage','Chalet','Cards and reservations','Other'];
        foreach ($holidays as $holiday){
            $category = new Category();
            $category->setName($holiday);
            $category->setParent($this->getReference('Holidays'));
            $manager->persist($category);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            GeneralCategoryFixtures::class,
        ];
    }
}

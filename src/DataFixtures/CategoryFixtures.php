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
        $types = ['Offer','Demand','SearchOffer','SearchDemand'];
        $this->addCategory($manager,$types);
        /*$vehicles = ['Car','Motor','Caravan','Boat','Agricultural machinery','Car parts','Motor parts','Vehicle accessories','vehicle_other'];
        foreach ($vehicles as $vehicle){
            $category = new Category();
            if($vehicle === 'vehicle_other'){
                $category->setName('Other');
            }
            else{
                $category->setName($vehicle);
            }

            $category->setParent($this->getReference('Vehicles'));
            $this->addReference($vehicle,$category);
            $manager->persist($category);
        }
        $jobs = ['Job opportunity','Translation','Mathematics lessons','Music lessons','Language lessons','Language exchange',
                 'House work','Maintenance services','jobs_other'];
        foreach ($jobs as $job){
            $category = new Category();
            if($job === 'jobs_other'){
                $category->setName('Other');
            }
            else{
                $category->setName($job);
            }
            $category->setParent($this->getReference('Jobs and services'));
            $this->addReference($job,$category);
            $manager->persist($category);
        }

        $medias = ['TV','Wolkman','Camera','Audio accessories','Camera accessories',
                   'Headphones','Telephone','Video games','DVD Games','Games accessories','Movies','Books','media_Other'];
        foreach ($medias as $media){
            $category = new Category();
            if($media === 'media_Other'){
                $category->setName('Other');
            }
            else{
                $category->setName($media);
            }
            $category->setParent($this->getReference('Media'));
            $this->addReference($media,$category);
            $manager->persist($category);
        }

        $informations = ['Computer','laptop','Tablet','Mobile','Scanner','Printer',
                   'Monitor','information_mouse','keyboard','Speaker','Hard disk','information_Other'];
        foreach ($informations as $information){
            $category = new Category();
            if($information === 'information_Other'){
                $category->setName('Other');
            }
            elseif($information === 'information_mouse'){
                $category->setName('Mouse');
            }
            else{
                $category->setName($information);
            }
            $category->setParent($this->getReference('Information'));
            $this->addReference($information,$category);
            $manager->persist($category);
        }

        $fashions = ['T-shirt','Shirt','Trouser','Short','Costume','Dress',
            'Wedding dress','Jacket','Langerie','Shoe','Slide sandal','Athletic shoe','fashion_Other'];
        foreach ($fashions as $fashion){
            $category = new Category();
            if($fashion === 'fashion_Other'){
                $category->setName('Other');
            }
            else{
                $category->setName($fashion);
            }
            $category->setParent($this->getReference('Fashion'));
            $this->addReference($fashion,$category);
            $manager->persist($category);
        }

        $homeAppliances = ['Refrigerator','Cookers gas','Cookers electric','Gas plate','Washing machine','Fan','Coffee machine'
                            ,'Electric kettle','Vaccuum cleaner','Oven','Blender','Stand Mixer','Dishwashers','Electric fryer'
                            ,'Freezer','Pressure cooker','Heater','Iron','Men\'s shaver','Lady shavers','Sandwich toaster'
                            ,'Meat grinder','Grilling charcoal','Hair dryer','Juicer machine','Electric vegetable','Kitchen accessories','home_Other'];
        foreach ($homeAppliances as $homeAppliance){
            $category = new Category();
            if($homeAppliance === 'home_Other'){
                $category->setName('Other');
            }
            else{
                $category->setName($homeAppliance);
            }
            $category->setParent($this->getReference('Home appliances'));
            $this->addReference($homeAppliance,$category);
            $manager->persist($category);
        }

        $gardens = ['Garden table','Swing','Seedlings','Garden chair','Lawn mower','Chainsaw',
            'Garden tools','Fuelwood','Electric generator','garden_Other'];
        foreach ($gardens as $garden){
            $category = new Category();
            if($garden === 'garden_Other'){
                $category->setName('Other');
            }
            else{
                $category->setName($garden);
            }
            $category->setParent($this->getReference('Agriculture and gardens'));
            $this->addReference($garden,$category);
            $manager->persist($category);
        }

        $residences = ['Sell house','Sell apartment','Sell office','Sell shop','Sell car parking','Sell farm',
            'Rent house','Rent apartment','Office rental','Rent shop','Rent car parking','Rent farm','Collective housing','residence_Other'];
        foreach ($residences as $residence){
            $category = new Category();
            if($residence === 'residence_Other'){
                $category->setName('Other');
            }
            else{
                $category->setName($residence);
            }
            $category->setParent($this->getReference('Residence'));
            $this->addReference($residence,$category);
            $manager->persist($category);
        }
        $jewelrys = ['Necklaces','Collier','Bracelet','Ring','Watch','Earrings',
            'Perfumes','Wine','jewelry_Other'];
        foreach ($jewelrys as $jewelry){
            $category = new Category();
            if($jewelry === 'jewelry_Other'){
                $category->setName('Other');
            }
            else{
                $category->setName($jewelry);
            }
            $category->setParent($this->getReference('Jewelry and accessories'));
            $this->addReference($jewelry,$category);
            $manager->persist($category);
        }

        $musics = ['Piano','Violin','Trumpet','Flute','Clarinet','Drums',
            'Cello','Contrabass','Electric guitar','Classic guitar','Digital keyboard','Accordion','Music accessories','music_Other'];
        foreach ($musics as $music){
            $category = new Category();
            if($music === 'music_Other'){
                $category->setName('Other');
            }
            else{
                $category->setName($music);
            }
            $category->setParent($this->getReference('Music'));
            $this->addReference($music,$category);
            $manager->persist($category);
        }

        $sports = ['Ski boots','Roller skating','Parachute','Swimming glasses','Football','Basketball',
            'Iron balls','Volley ball','American football','Sports tool','Bicycle','Bicycle accessories','sport_Other'];
        foreach ($sports as $sport){
            $category = new Category();
            if($sport === 'sport_Other'){
                $category->setName('Other');
            }
            else{
                $category->setName($sport);
            }
            $category->setParent($this->getReference('Sport'));
            $this->addReference($sport,$category);
            $manager->persist($category);
        }

        $Pets = ['Cat','Dog','Hamster','Mouse','pet_Other'];
        foreach ($Pets as $Pet){
            $category = new Category();
            if($Pet === 'pet_Other'){
                $category->setName('Other');
            }
            else{
                $category->setName($Pet);
            }
            $category->setParent($this->getReference('Pets'));
            $this->addReference($Pet,$category);
            $manager->persist($category);
        }

        $kids = ['Crib','kids_Chest of drawers','Stroller','Diapers','kids_Mattress','Baby clothes',
            'Baby tools','Baby toys','kid_Other'];
        foreach ($kids as $kid){
            $category = new Category();
            if($kid === 'kid_Other'){
                $category->setName('Other');
            }
            elseif($kid === 'kids_Chest of drawers'){
                $category->setName('Chest of drawers');
            }
            elseif($kid === 'kids_Mattress'){
                $category->setName('Mattress');
            }
            else{
                $category->setName($kid);
            }
            $category->setParent($this->getReference('Kids'));
            $this->addReference($kid,$category);
            $manager->persist($category);
        }

        $furnitures = ['Couch','Dining table','Chest of drawers','Closet','Central table','Bed','Mattress'
            ,'Quilt','Carpet','Chair','Office chair','Sofa','Racks','Study table','Click clack','Nightstand','Shoe cabinet'
            ,'Chandelier','Antic','Painting','Roses','Curtain','Floor lamp','Mirror','furniture_Other'];
        foreach ($furnitures as $furniture){
            $category = new Category();
            if($furniture === 'furniture_Other'){
                $category->setName('Other');
            }
            else{
                $category->setName($furniture);
            }
            $category->setParent($this->getReference('Furniture and decorations'));
            $this->addReference($furniture,$category);
            $manager->persist($category);
        }

        $holidays = ['Camp','Hotel','Cottage','Chalet','Cards and reservations','holiday_Other'];
        foreach ($holidays as $holiday){
            $category = new Category();
            if($holiday === 'holiday_Other'){
                $category->setName('Other');
            }
            else{
                $category->setName($holiday);
            }
            $category->setParent($this->getReference('Holidays'));
            $this->addReference($holiday,$category);
            $manager->persist($category);
        }
        $manager->flush();*/
    }

    public function addCategory (ObjectManager $manager,$types){
        foreach ($types as $type){

            $vehicles = ['Car','Motor','Caravan','Boat','Agricultural machinery','Car parts','Motor parts','Vehicle accessories','vehicle_other'];
            foreach ($vehicles as $vehicle){
                $category = new Category();
                if($vehicle === 'vehicle_other'){
                    $category->setName('Other');
                }
                else{
                    $category->setName($vehicle);
                }

                $category->setParent($this->getReference('Vehicles'.'_'.$type));
                $category->setType($type);
                $this->addReference($vehicle.'_'.$type,$category);
                $manager->persist($category);
            }
            $jobs = ['Job opportunity','Translation','Mathematics lessons','Music lessons','Language lessons','Language exchange',
                'House work','Maintenance services','jobs_other'];
            foreach ($jobs as $job){
                $category = new Category();
                if($job === 'jobs_other'){
                    $category->setName('Other');
                }
                else{
                    $category->setName($job);
                }
                $category->setParent($this->getReference('Jobs and services'.'_'.$type));
                $category->setType($type);
                $this->addReference($job.'_'.$type,$category);
                $manager->persist($category);
            }

            $medias = ['TV','Wolkman','Camera','Audio accessories','Camera accessories',
                'Headphones','Telephone','Video games','DVD Games','Games accessories','Movies','Books','media_Other'];
            foreach ($medias as $media){
                $category = new Category();
                if($media === 'media_Other'){
                    $category->setName('Other');
                }
                else{
                    $category->setName($media);
                }
                $category->setParent($this->getReference('Media'.'_'.$type));
                $category->setType($type);
                $this->addReference($media.'_'.$type,$category);
                $manager->persist($category);
            }

            $informations = ['Computer','laptop','Tablet','Mobile','Scanner','Printer',
                'Monitor','information_mouse','keyboard','Speaker','Hard disk','information_Other'];
            foreach ($informations as $information){
                $category = new Category();
                if($information === 'information_Other'){
                    $category->setName('Other');
                }
                elseif($information === 'information_mouse'){
                    $category->setName('Mouse');
                }
                else{
                    $category->setName($information);
                }
                $category->setParent($this->getReference('Information'.'_'.$type));
                $category->setType($type);
                $this->addReference($information.'_'.$type,$category);
                $manager->persist($category);
            }

            $fashions = ['T-shirt','Shirt','Trouser','Short','Costume','Dress',
                'Wedding dress','Jacket','Langerie','Shoe','Slide sandal','Athletic shoe','fashion_Other'];
            foreach ($fashions as $fashion){
                $category = new Category();
                if($fashion === 'fashion_Other'){
                    $category->setName('Other');
                }
                else{
                    $category->setName($fashion);
                }
                $category->setParent($this->getReference('Fashion'.'_'.$type));
                $category->setType($type);
                $this->addReference($fashion.'_'.$type,$category);
                $manager->persist($category);
            }

            $homeAppliances = ['Refrigerator','Cookers gas','Cookers electric','Gas plate','Washing machine','Fan','Coffee machine'
                ,'Electric kettle','Vaccuum cleaner','Oven','Blender','Stand Mixer','Dishwashers','Electric fryer'
                ,'Freezer','Pressure cooker','Heater','Iron','Men\'s shaver','Lady shavers','Sandwich toaster'
                ,'Meat grinder','Grilling charcoal','Hair dryer','Juicer machine','Electric vegetable','Kitchen accessories','home_Other'];
            foreach ($homeAppliances as $homeAppliance){
                $category = new Category();
                if($homeAppliance === 'home_Other'){
                    $category->setName('Other');
                }
                else{
                    $category->setName($homeAppliance);
                }
                $category->setParent($this->getReference('Home appliances'.'_'.$type));
                $category->setType($type);
                $this->addReference($homeAppliance.'_'.$type,$category);
                $manager->persist($category);
            }

            $gardens = ['Garden table','Swing','Seedlings','Garden chair','Lawn mower','Chainsaw',
                'Garden tools','Fuelwood','Electric generator','garden_Other'];
            foreach ($gardens as $garden){
                $category = new Category();
                if($garden === 'garden_Other'){
                    $category->setName('Other');
                }
                else{
                    $category->setName($garden);
                }
                $category->setParent($this->getReference('Agriculture and gardens'.'_'.$type));
                $category->setType($type);
                $this->addReference($garden.'_'.$type,$category);
                $manager->persist($category);
            }

            $residences = ['Sell house','Sell apartment','Sell office','Sell shop','Sell car parking','Sell farm',
                'Rent house','Rent apartment','Office rental','Rent shop','Rent car parking','Rent farm','Collective housing','residence_Other'];
            foreach ($residences as $residence){
                $category = new Category();
                if($residence === 'residence_Other'){
                    $category->setName('Other');
                }
                else{
                    $category->setName($residence);
                }
                $category->setParent($this->getReference('Residence'.'_'.$type));
                $category->setType($type);
                $this->addReference($residence.'_'.$type,$category);
                $manager->persist($category);
            }
            $jewelrys = ['Necklaces','Collier','Bracelet','Ring','Watch','Earrings',
                'Perfumes','Wine','jewelry_Other'];
            foreach ($jewelrys as $jewelry){
                $category = new Category();
                if($jewelry === 'jewelry_Other'){
                    $category->setName('Other');
                }
                else{
                    $category->setName($jewelry);
                }
                $category->setParent($this->getReference('Jewelry and accessories'.'_'.$type));
                $category->setType($type);
                $this->addReference($jewelry.'_'.$type,$category);
                $manager->persist($category);
            }

            $musics = ['Piano','Violin','Trumpet','Flute','Clarinet','Drums',
                'Cello','Contrabass','Electric guitar','Classic guitar','Digital keyboard','Accordion','Music accessories','music_Other'];
            foreach ($musics as $music){
                $category = new Category();
                if($music === 'music_Other'){
                    $category->setName('Other');
                }
                else{
                    $category->setName($music);
                }
                $category->setParent($this->getReference('Music'.'_'.$type));
                $category->setType($type);
                $this->addReference($music.'_'.$type,$category);
                $manager->persist($category);
            }

            $sports = ['Ski boots','Roller skating','Parachute','Swimming glasses','Football','Basketball',
                'Iron balls','Volley ball','American football','Sports tool','Bicycle','Bicycle accessories','sport_Other'];
            foreach ($sports as $sport){
                $category = new Category();
                if($sport === 'sport_Other'){
                    $category->setName('Other');
                }
                else{
                    $category->setName($sport);
                }
                $category->setParent($this->getReference('Sport'.'_'.$type));
                $category->setType($type);
                $this->addReference($sport.'_'.$type,$category);
                $manager->persist($category);
            }

            $Pets = ['Cat','Dog','Hamster','Mouse','pet_Other'];
            foreach ($Pets as $Pet){
                $category = new Category();
                if($Pet === 'pet_Other'){
                    $category->setName('Other');
                }
                else{
                    $category->setName($Pet);
                }
                $category->setParent($this->getReference('Pets'.'_'.$type));
                $category->setType($type);
                $this->addReference($Pet.'_'.$type,$category);
                $manager->persist($category);
            }

            $kids = ['Crib','kids_Chest of drawers','Stroller','Diapers','kids_Mattress','Baby clothes',
                'Baby tools','Baby toys','kid_Other'];
            foreach ($kids as $kid){
                $category = new Category();
                if($kid === 'kid_Other'){
                    $category->setName('Other');
                }
                elseif($kid === 'kids_Chest of drawers'){
                    $category->setName('Chest of drawers');
                }
                elseif($kid === 'kids_Mattress'){
                    $category->setName('Mattress');
                }
                else{
                    $category->setName($kid);
                }
                $category->setParent($this->getReference('Kids'.'_'.$type));
                $category->setType($type);
                $this->addReference($kid.'_'.$type,$category);
                $manager->persist($category);
            }

            $furnitures = ['Couch','Dining table','Chest of drawers','Closet','Central table','Bed','Mattress'
                ,'Quilt','Carpet','Chair','Office chair','Sofa','Racks','Study table','Click clack','Nightstand','Shoe cabinet'
                ,'Chandelier','Antic','Painting','Roses','Curtain','Floor lamp','Mirror','furniture_Other'];
            foreach ($furnitures as $furniture){
                $category = new Category();
                if($furniture === 'furniture_Other'){
                    $category->setName('Other');
                }
                else{
                    $category->setName($furniture);
                }
                $category->setParent($this->getReference('Furniture and decorations'.'_'.$type));
                $category->setType($type);
                $this->addReference($furniture.'_'.$type,$category);
                $manager->persist($category);
            }

            $holidays = ['Camp','Hotel','Cottage','Chalet','Cards and reservations','holiday_Other'];
            foreach ($holidays as $holiday){
                $category = new Category();
                if($holiday === 'holiday_Other'){
                    $category->setName('Other');
                }
                else{
                    $category->setName($holiday);
                }
                $category->setParent($this->getReference('Holidays'.'_'.$type));
                $category->setType($type);
                $this->addReference($holiday.'_'.$type,$category);
                $manager->persist($category);
            }
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

<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\DataFixtures\UserFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Ads\Ad;



class AdFixtures/* extends Fixture implements DependentFixtureInterface*/
{
    public function load(ObjectManager $manager)
    {

       /* $ad1 = new Ad();
        $ad1->setTitle('Voiture a vendre');
        $ad1->setPrice(1400);
        $ad1->setTypeOfAd('Offer');
        $ad1->setImageOne('5f1f2a899c9cdd6c04032e66384c025e.png');
        $ad1->setCategory($this->getReference('Car_Offer'));
        $ad1->setGeneralCategory($this->getReference('Vehicles_Offer'));
        $ad1->setUser($this->getReference('naji'));
        $manager->persist($ad1);


        $ad2 = new Ad();
        $ad2->setTitle('Voiture a vendre');
        $ad2->setPrice(1200);
        $ad2->setTypeOfAd('Demand');
        $ad2->setCategory($this->getReference('Motor_Offer'));
        $ad2->setGeneralCategory($this->getReference('Vehicles_Offer'));
        $ad2->setUser($this->getReference('naji'));
        $manager->persist($ad2);

        $ad3 = new Ad();
        $ad3->setTitle('Voiture a vendre');
        $ad3->setPrice(300);
        $ad3->setTypeOfAd('Offer');
        $ad3->setImageOne('76a889ea24b67a1e531a97ab5b0b9158.jpeg');
        $ad3->setCategory($this->getReference('Translation_Offer'));
        $ad3->setGeneralCategory($this->getReference('Jobs and services_Offer'));
        $ad3->setUser($this->getReference('reem'));
        $manager->persist($ad3);

        $ad4 = new Ad();
        $ad4->setTitle('Voiture a vendre');
        $ad4->setPrice(120);
        $ad4->setTypeOfAd('Demand');
        $ad4->setCategory($this->getReference('House work_Offer'));
        $ad4->setGeneralCategory($this->getReference('Jobs and services_Offer'));
        $ad4->setUser($this->getReference('reem'));
        $manager->persist($ad4);

        $ad5 = new Ad();
        $ad5->setTitle('Camera a vendre');
        $ad5->setPrice(270);
        $ad5->setTypeOfAd('Offer');
        $ad5->setImageOne('53d352860eafee85394000770594e6ee.jpeg');
        $ad5->setCategory($this->getReference('Camera_Offer'));
        $ad5->setGeneralCategory($this->getReference('Media_Offer'));
        $ad5->setUser($this->getReference('sami'));
        $manager->persist($ad5);

        $ad6 = new Ad();
        $ad6->setTitle('Books a vendre');
        $ad6->setPrice(2400);
        $ad6->setTypeOfAd('Demand');
        $ad6->setCategory($this->getReference('Books_Offer'));
        $ad6->setGeneralCategory($this->getReference('Media_Offer'));
        $ad6->setUser($this->getReference('sami'));
        $manager->persist($ad6);

        $ad7 = new Ad();
        $ad7->setTitle('Voiture a vendre');
        $ad7->setPrice(15);
        $ad7->setTypeOfAd('Offer');
        $ad7->setImageOne('94b136e9acfabc8cea758d8271fe3f01.png');
        $ad7->setCategory($this->getReference('Mobile_Offer'));
        $ad7->setGeneralCategory($this->getReference('Information_Offer'));
        $ad7->setUser($this->getReference('mich'));
        $manager->persist($ad7);

        $ad8 = new Ad();
        $ad8->setTitle('Voiture a vendre');
        $ad8->setPrice(60);
        $ad8->setTypeOfAd('Demand');
        $ad8->setCategory($this->getReference('Speaker_Offer'));
        $ad8->setGeneralCategory($this->getReference('Information_Offer'));
        $ad8->setUser($this->getReference('mich'));
        $manager->persist($ad8);

        $ad9 = new Ad();
        $ad9->setTitle('Dress a vendre');
        $ad9->setPrice(45);
        $ad9->setTypeOfAd('Offer');
        $ad9->setImageOne('5f1f2a899c9cdd6c04032e66384c025e.png');
        $ad9->setCategory($this->getReference('Dress_Offer'));
        $ad9->setGeneralCategory($this->getReference('Fashion_Offer'));
        $ad9->setUser($this->getReference('nazem'));
        $manager->persist($ad9);

        $ad10 = new Ad();
        $ad10->setTitle('Jacket');
        $ad10->setPrice(214.2);
        $ad10->setTypeOfAd('Demand');
        $ad10->setCategory($this->getReference('Jacket_Offer'));
        $ad10->setGeneralCategory($this->getReference('Fashion_Offer'));
        $ad10->setUser($this->getReference('nazem'));
        $manager->persist($ad10);

        $ad11 = new Ad();
        $ad11->setTitle('Oven a vendre');
        $ad11->setPrice(1800);
        $ad11->setTypeOfAd('Offer');
        $ad11->setImageOne('706647f55641ff9dbd3a51b39e9104df.png');
        $ad11->setCategory($this->getReference('Oven_Offer'));
        $ad11->setGeneralCategory($this->getReference('Home appliances_Offer'));
        $ad11->setUser($this->getReference('wael'));
        $manager->persist($ad11);

        $ad12 = new Ad();
        $ad12->setTitle('Sandwich toaster');
        $ad12->setPrice(550);
        $ad12->setTypeOfAd('Demand');
        $ad12->setCategory($this->getReference('Sandwich toaster_Offer'));
        $ad12->setGeneralCategory($this->getReference('Home appliances_Offer'));
        $ad12->setUser($this->getReference('wael'));
        $manager->persist($ad12);

        $ad13 = new Ad();
        $ad13->setTitle('Voiture a vendre');
        $ad13->setPrice(612.25);
        $ad13->setTypeOfAd('Offer');
        $ad13->setImageOne('b2b4b67ee8a4afbdb9a1f45a3dd9c8af.jpeg');
        $ad13->setCategory($this->getReference('Seedlings_Offer'));
        $ad13->setGeneralCategory($this->getReference('Agriculture and gardens_Offer'));
        $ad13->setUser($this->getReference('samera'));
        $manager->persist($ad13);

        $ad14 = new Ad();
        $ad14->setTitle('Voit');
        $ad14->setPrice(3.5);
        $ad14->setTypeOfAd('Demand');
        $ad14->setCategory($this->getReference('Fuelwood_Offer'));
        $ad14->setGeneralCategory($this->getReference('Agriculture and gardens_Offer'));
        $ad14->setUser($this->getReference('samera'));
        $manager->persist($ad14);

        $ad15 = new Ad();
        $ad15->setTitle('Voiture a vendre');
        $ad15->setPrice(4800);
        $ad15->setTypeOfAd('Offer');
        $ad15->setImageOne('f18b20d69651d1f61367133206646b46.jpeg');
        $ad15->setCategory($this->getReference('Sell apartment_Offer'));
        $ad15->setGeneralCategory($this->getReference('Residence_Offer'));
        $ad15->setUser($this->getReference('razan'));
        $manager->persist($ad15);

        $ad16 = new Ad();
        $ad16->setTitle('Voiture a vendre');
        $ad16->setPrice(614.35);
        $ad16->setTypeOfAd('Demand');
        $ad16->setCategory($this->getReference('Bracelet_Offer'));
        $ad16->setUser($this->getReference('razan'));
        $ad16->setGeneralCategory($this->getReference('Jewelry and accessories_Offer'));
        $manager->persist($ad16);

        $manager->flush();*/
    }

    public function getDependencies()
    {
       /* return [
            UserFixtures::class,
            CategoryFixtures::class,
            GeneralCategoryFixtures::class,
        ];*/
    }
}

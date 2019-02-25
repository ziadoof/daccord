<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;



class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        //create sub category
        $user1 = new User();
        $user1->setEmail('ziadoof@gmail.com');
        $password = $this->encoder->encodePassword($user1, 'qsdqsd');
        $user1->setPassword($password);
        $user1->setFirstname('Naji');
        $user1->setLastname('ALABED');

        $manager->persist($user1);



        $manager->flush();
    }


}

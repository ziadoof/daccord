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
        $user = new User();
        $user->setEmail('ziadoof@gmail.com');
        $password = $this->encoder->encodePassword($user, 'Mrn$1980Mrn$');
        $user->setPassword($password);
        $user->setFirstname('Naji');
        $user->setLastname('ALABED');
        $user->setUsername('Ziadoof');
        $user->setRoles(['ROLE_ADMIN']);
        /*$this->addReference('naji',$user1);*/

        $manager->persist($user);

        //create sub category
        $user1 = new User();
        $user1->setEmail('support@dispodeal.com');
        $password = $this->encoder->encodePassword($user1, 'Mrn$1980Mrn$');
        $user1->setPassword($password);
        $user1->setFirstname('Dispo');
        $user1->setLastname('Deal');
        $user1->setUsername('DD');
        /*$this->addReference('naji',$user1);*/

        $manager->persist($user1);

        $user2 = new User();
        $user2->setEmail('info@dispodeal.com');
        $password = $this->encoder->encodePassword($user2, 'Mrn$1980Mrn$');
        $user2->setPassword($password);
        $user2->setFirstname('Dispo');
        $user2->setLastname('deal');
        $user2->setUsername('DDFR');
        /*$this->addReference('reem',$user2);*/

        $manager->persist($user2);

        /*$user3 = new User();
        $user3->setEmail('ziadoof3@gmail.com');
        $password = $this->encoder->encodePassword($user3, '123');
        $user3->setPassword($password);
        $user3->setFirstname('Sami');
        $user3->setLastname('AHMAD');
        $user3->setUsername('AHMED');
        $this->addReference('sami',$user3);

        $manager->persist($user3);

        $user6 = new User();
        $user6->setEmail('ziadoof6@gmail.com');
        $password = $this->encoder->encodePassword($user6, '123');
        $user6->setPassword($password);
        $user6->setFirstname('Michal');
        $user6->setLastname('GAGO');
        $user6->setUsername('GAGO');
        $this->addReference('mich',$user6);

        $manager->persist($user6);

        $user4 = new User();
        $user4->setEmail('ziadoof4@gmail.com');
        $password = $this->encoder->encodePassword($user4, '123');
        $user4->setPassword($password);
        $user4->setFirstname('Nazem');
        $user4->setLastname('ALHAMADI');
        $user4->setUsername('alhamadi');
        $this->addReference('nazem',$user4);

        $manager->persist($user4);

        $user5 = new User();
        $user5->setEmail('ziadoof5@gmail.com');
        $password = $this->encoder->encodePassword($user5, '123');
        $user5->setPassword($password);
        $user5->setFirstname('Wael');
        $user5->setLastname('HMADEH');
        $user5->setUsername('hamadi');
        $this->addReference('wael',$user5);

        $manager->persist($user5);

        $user7 = new User();
        $user7->setEmail('ziadoof7@gmail.com');
        $password = $this->encoder->encodePassword($user7, '123');
        $user7->setPassword($password);
        $user7->setFirstname('Samera');
        $user7->setLastname('ALKHALIL');
        $user7->setUsername('alkhalil');
        $this->addReference('samera',$user7);

        $manager->persist($user7);

        $user8 = new User();
        $user8->setEmail('ziadoof8@gmail.com');
        $password = $this->encoder->encodePassword($user8, '123');
        $user8->setPassword($password);
        $user8->setFirstname('Razan');
        $user8->setLastname('ZAITOUNEH');
        $user8->setUsername('zaitouneh');
        $this->addReference('razan',$user8);

        $manager->persist($user8);*/

        $manager->flush();
    }


}

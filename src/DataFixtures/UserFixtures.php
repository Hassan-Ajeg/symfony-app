<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    /**
     * UserFixtures constructor.
     * @param $encoder
     */
    //création du constructeur avec encoder en params
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }


    public function load(ObjectManager $manager)
    {
        //création d'une instance de User
        //
        $user = new User();
        $user->setUsername("toto")
            ->setRoles(["ROLE_CREATOR"])
            //appel de la méthode encodePassword qui prend en param l'user crée et le mot de passe en clair
            ->setPassword($this->encoder->encodePassword($user, "123"));
        $manager->persist($user);

        $manager->flush();
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\Author;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AuthorFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $auhtor = new Author();
        $auhtor->setFirstName("Georges")
            ->setName("Sand")
            ->setDateOfBirth(new \DateTime("1804-07-01"));
        $manager->persist($auhtor);
        $this->addReference("author_sand",$auhtor);

        $auhtor = new Author();
        $auhtor->setFirstName("Carlos")
            ->setName("Cardin")
            ->setDateOfBirth(new \DateTime("1864-07-01"));
        $manager->persist($auhtor);
        $this->addReference("author_cardin", $auhtor);

        $auhtor = new Author();
        $auhtor->setFirstName("Victor")
            ->setName("Hugo")
            ->setDateOfBirth(new \DateTime("1904-08-01"));
        $manager->persist($auhtor);
        $this->addReference("author_hugo", $auhtor);

        $auhtor = new Author();
        $auhtor->setFirstName("Jean")
            ->setName("Moulin")
            ->setDateOfBirth(new \DateTime("1944-08-01"));
        $manager->persist($auhtor);
        $this->addReference("author_moulin", $auhtor);

        $manager->flush();
    }
}

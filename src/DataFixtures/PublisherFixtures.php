<?php

namespace App\DataFixtures;

use App\Entity\Publisher;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PublisherFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $publisher = new Publisher();
        $publisher->setName("Flammarion")
            ->setCreatedAt(new \DateTime("1965-03-12"));
        $manager->persist($publisher);
        $this->addReference("publisher_flammarion", $publisher);

        $publisher = new Publisher();
        $publisher->setName("Hachette")
            ->setCreatedAt(new \DateTime("1934-03-12"));
        $manager->persist($publisher);
        $this->addReference("publisher_hachette", $publisher);

        $publisher = new Publisher();
        $publisher->setName("Folio")
            ->setCreatedAt(new \DateTime("1912-03-12"));
        $manager->persist($publisher);
        $this->addReference("publisher_folio", $publisher);


        $publisher = new Publisher();
        $publisher->setName("Gallimard")
            ->setCreatedAt(new \DateTime("1943-07-15"));
        $manager->persist($publisher);
        $this->addReference("publisher_gallimard", $publisher);


        $publisher = new Publisher();
        $publisher->setName("Atlas")
            ->setCreatedAt(new \DateTime("1985-03-12"));
        $manager->persist($publisher);
        $this->addReference("publisher_atlas", $publisher);

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}

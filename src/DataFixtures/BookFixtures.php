<?php

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class BookFixtures extends Fixture
{
    private $authorList = [
        "Aristote", "Socrate", "Victor Hugo", "Jean-Paul Sartre", "Pierre de Ronsard", "Sophie Calle", "Anne Rice"
    ];
    private $genreList = [
        "Poésie", "Roman", "Policier", "Nouvelle", "Essai", "Autobiographie"
    ];
    private $publisherList = [
        "Grasset", "Hachette", "Le seuil", "Flammarion", "Folio"
    ];

    private Generator $faker;

    public function __construct()
    {
        //instance de Faker
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 100; $i++) {
            $book = $this->createBook();
            $manager->persist($book);
        }
        $manager->flush();
    }
    private function createBook()
    {
        $book = new Book();
        $book->setTitle($this->faker->catchPhrase)
            ->setAuthor($this->chooseOne($this->authorList))
            ->setPublishedAt($this->faker->dateTimeThisCentury())
            ->setPrice($this->faker->numberBetween(500, 90000) / 100)
            ->setGenre($this->chooseOne($this->genreList))
            ->setPublisher($this->chooseOne($this->publisherList))
            ->setSynopsis($this->faker->paragraph(8));
        return $book;
    }

    private function chooseOne($collection)
    {
        return $collection[array_rand($collection)];
    }
    /***
     * $book1 = $this->createBook();
     * $manager->persist($book1);
     *
     * //création d'un nv livre
     * $book2 = $this->createBook(
     * "le rouge et le noir",
     * "Stendhal",
     * new \DateTime("1905-4-5"),
     * 16,
     * "Roman",
     * "Folio",
     * "Un texte intéressant"
     *
     * );
     * $manager->persist($book2);
     * //création d'un nv livre
     * $book3 = $this->createBook(
     * "Les fables",
     * "Jean Delafontaine",
     * new \DateTime("1905-4-5"),
     * 10,
     * "Fable",
     * "Flammarion",
     * "Un texte important"
     *
     * );
     * $manager->persist($book3);
     *
     * //création d'un nv livre
     * $book4 = $this->createBook(
     * "La gloire de mon père",
     * "Marcel Pagnol",
     * new \DateTime("1993-4-5"),
     * 10,
     * "Nouvelle",
     * "Flammarion",
     * "Un texte important"
     *
     * );
     * $manager->persist($book4);
     *
     * $manager->flush();
     */
}

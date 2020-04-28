<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AuthorRepository")
 */
class Author
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Le nom ne peut être vide")
     * @Assert\Regex(pattern="/^[a-z èéêàçâ\-]*$/i", message="Uniquement des caractères alphabétiques")
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @Assert\Regex(pattern="/^[a-z èéêàçâ\-]*$/i", message="Uniquement des caractères alphabétiques")
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $firstName;

    /**
     * @Assert\NotBlank(message="La date de naissance doit être renseingée")
     * @Assert\LessThan("-18 years", message="Un auteur doit être majeur")
     * @ORM\Column(type="date")
     */
    private $dateOfBirth;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Book", mappedBy="author")
     */
    private $books;

    public function __construct()
    {
        $this->books = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(\DateTimeInterface $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    public function __toString()
    {
        $fullName = "";
        if(! empty($this->firstName)){
            $fullName.= $this->firstName. " ";
        }
        $fullName .= strtoupper($this->name);

        return $fullName;
    }

    /**
     * @return Collection|Book[]
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBook(Book $book): self
    {
        if (!$this->books->contains($book)) {
            $this->books[] = $book;
            $book->setAuthor($this);
        }

        return $this;
    }

    public function removeBook(Book $book): self
    {
        if ($this->books->contains($book)) {
            $this->books->removeElement($book);
            // set the owning side to null (unless already changed)
            if ($book->getAuthor() === $this) {
                $book->setAuthor(null);
            }
        }

        return $this;
    }

}

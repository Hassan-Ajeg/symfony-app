<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PublisherRepository")
 */
class Publisher
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Le nom ne peut être vide")
     * @Assert\Regex(pattern="/^[a-z 0-9 èéêàçâ\-]*$/i", message="Uniquement des caractères alpha-numériques")
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @Assert\NotBlank(message="La date de création doit être renseignée")
     * @Assert\LessThan("today",message="La date de création doit être antérieure à la date du jour")
     * @ORM\Column(type="date")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Book", mappedBy="publisher")
     */
    private $bookList;

    public function __construct()
    {
        $this->bookList = new ArrayCollection();
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return Collection|Book[]
     */
    public function getBookList(): Collection
    {
        return $this->bookList;
    }

    public function addBookList(Book $bookList): self
    {
        if (!$this->bookList->contains($bookList)) {
            $this->bookList[] = $bookList;
            $bookList->setPublisher($this);
        }

        return $this;
    }

    public function removeBookList(Book $bookList): self
    {
        if ($this->bookList->contains($bookList)) {
            $this->bookList->removeElement($bookList);
            // set the owning side to null (unless already changed)
            if ($bookList->getPublisher() === $this) {
                $bookList->setPublisher(null);
            }
        }

        return $this;
    }

}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserTomeRepository")
 * @ORM\Table(uniqueConstraints={
 *        @ORM\UniqueConstraint(name="u_user_tome_book", columns={"user_id", "tome_id", "book_id"})
 * })
 */
class UserTome
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="userTomes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tome")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tome;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Book")
     * @ORM\JoinColumn(nullable=false)
     */
    private $book;
    /**
     * @ORM\Column(type="datetime")
     */
    private $creationDatetime;



    public function __construct()
    {
        $this->creationDatetime = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTome(): ?Tome
    {
        return $this->tome;
    }

    public function setTome(?Tome $tome): self
    {
        $this->tome = $tome;

        return $this;
    }

    public function getCreationDatetime(): ?\DateTimeInterface
    {
        return $this->creationDatetime;
    }

    public function setCreationDatetime(\DateTimeInterface $creationDatetime): self
    {
        $this->creationDatetime = $creationDatetime;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getBook(): ?Book
    {
        return $this->book;
    }

    public function setBook(?Book $book): self
    {
        $this->book = $book;

        return $this;
    }
}

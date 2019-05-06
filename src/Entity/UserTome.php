<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserTomeRepository")
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Tome", inversedBy="userTomes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tome", inversedBy="userTomes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tome;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creationDatetime;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?Tome
    {
        return $this->user;
    }

    public function setUser(?Tome $user): self
    {
        $this->user = $user;

        return $this;
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
}

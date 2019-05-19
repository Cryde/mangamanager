<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookRepository")
 */
class Book
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;
    /**
     * @ORM\Column(type="datetime")
     */
    private $creationDatetime;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $editionDatetime;
    /**
     * @ORM\Column(type="datetime")
     */
    private $publicationDatetime;
    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $slug;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tome", mappedBy="book")
     */
    private $tomes;
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\BookAuthor", inversedBy="books")
     * @ORM\JoinTable(name="map_book_author")
     */
    private $authors;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BookStatus", inversedBy="books")
     * @ORM\JoinColumn(nullable=false)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BookType", inversedBy="books")
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $coverUrl;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $coverPath;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tomeNumber;

    public function __construct()
    {
        $this->creationDatetime = new \DateTimeImmutable();
        $this->tomes = new ArrayCollection();
        $this->authors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEditionDatetime(): ?\DateTimeInterface
    {
        return $this->editionDatetime;
    }

    public function setEditionDatetime(\DateTimeInterface $editionDatetime): self
    {
        $this->editionDatetime = $editionDatetime;

        return $this;
    }

    public function getPublicationDatetime(): ?\DateTimeInterface
    {
        return $this->publicationDatetime;
    }

    public function setPublicationDatetime(\DateTimeInterface $publicationDatetime): self
    {
        $this->publicationDatetime = $publicationDatetime;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Tome[]
     */
    public function getTomes(): Collection
    {
        return $this->tomes;
    }

    public function addTome(Tome $tome): self
    {
        if (!$this->tomes->contains($tome)) {
            $this->tomes[] = $tome;
            $tome->setBook($this);
        }

        return $this;
    }

    public function removeTome(Tome $tome): self
    {
        if ($this->tomes->contains($tome)) {
            $this->tomes->removeElement($tome);
            // set the owning side to null (unless already changed)
            if ($tome->getBook() === $this) {
                $tome->setBook(null);
            }
        }

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection|BookAuthor[]
     */
    public function getAuthors(): Collection
    {
        return $this->authors;
    }

    public function addAuthor(BookAuthor $author): self
    {
        if (!$this->authors->contains($author)) {
            $this->authors[] = $author;
        }

        return $this;
    }

    public function removeAuthor(BookAuthor $author): self
    {
        if ($this->authors->contains($author)) {
            $this->authors->removeElement($author);
        }

        return $this;
    }

    public function getStatus(): ?BookStatus
    {
        return $this->status;
    }

    public function setStatus(?BookStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getType(): ?BookType
    {
        return $this->type;
    }

    public function setType(?BookType $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCoverUrl(): ?string
    {
        return $this->coverUrl;
    }

    public function setCoverUrl(?string $coverUrl): self
    {
        $this->coverUrl = $coverUrl;

        return $this;
    }

    public function getCoverPath(): ?string
    {
        return $this->coverPath;
    }

    public function setCoverPath(?string $coverPath): self
    {
        $this->coverPath = $coverPath;

        return $this;
    }

    public function getTomeNumber(): ?int
    {
        return $this->tomeNumber;
    }

    public function setTomeNumber(?int $tomeNumber): self
    {
        $this->tomeNumber = $tomeNumber;

        return $this;
    }
}

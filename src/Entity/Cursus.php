<?php

namespace App\Entity;

use App\Entity\CursusContent;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CursusRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ORM\Entity(repositoryClass=CursusRepository::class)
 * @ApiResource(
 *  collectionOperations={
 *          "get" ={
 *              "path"="/cursus",
 *               "normalization_context"={"groups"={"cursussimple:read"}} 
 *              }
 *      }, 
 *  itemOperations={
 *          "get" ={
 *              "path"="/cursus/{id}",
 *              "normalization_context"={"groups"={"cursusdetail:read"}} 
 *              }
 *      }
 * )
 * 
 * @ApiFilter(SearchFilter::class,  properties={"level":"exact"})
 * @ApiFilter(RangeFilter::class, properties={"level"})
 * @ApiFilter(DateFilter::class, properties={"lastupdate":"strictly_after"})
 **/
class Cursus
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @Groups({"cursussimple:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * 
     * @Groups({"cursussimple:read"})
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"cursussimple:read"})
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * 
     * @Groups({"cursussimple:read"})
     */
    private $level;

    /**
     * @ORM\Column(type="integer")
     * 
     * @Groups({"cursussimple:read"})
     */
    private $rights;

    /**
     * @ORM\Column(type="integer")
     * 
     * @Groups({"cursussimple:read"})
     */
    private $points;

    /**
     * @ORM\Column(type="datetime_immutable")
     * 
     * @Groups({"cursussimple:read"})
     */
    private $lastupdate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups({"cursussimple:read"})
     */
    private $theme;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"cursussimple:read"})
     */
    private $subtitle;

    /**
     * @ORM\OneToMany(targetEntity=CursusContent::class, mappedBy="cursus", orphanRemoval=true)
     * 
     * @Groups({"cursusdetail:read"})
     */
    private $cursusContents;

    public function __construct()
    {
        $this->cursusContents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getRights(): ?int
    {
        return $this->rights;
    }

    public function setRights(int $rights): self
    {
        $this->rights = $rights;

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(int $points): self
    {
        $this->points = $points;

        return $this;
    }

    public function getLastupdate(): ?\DateTimeImmutable
    {
        return $this->lastupdate;
    }

    public function setLastupdate(\DateTimeImmutable $lastupdate): self
    {
        $this->lastupdate = $lastupdate;

        return $this;
    }


    /**
     * How long ago in text that this cheese listing was added.
     *
     * @Groups("cursussimple:read")
     * 
     */
    public function getNbComments(): ?int
    {
        return 10;
    }

    /**
     * How long ago in text that this cheese listing was added.
     *
     * @Groups("cursussimple:read")
     */
    public function getNotation(): int
    {
        return 5;
    }

    /**
     * How long ago in text that this cheese listing was added.
     *
     * @Groups("cursussimple:read")
     */
    public function getNbrecord(): int
    {
        return 5;
    }

    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function setTheme(?string $theme): self
    {
        $this->theme = $theme;

        return $this;
    }

    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    public function setSubtitle(string $subtitle): self
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    /**
     * @return Collection|CursusContent[]
     */
    public function getCursusContents(): Collection
    {
        return $this->cursusContents;
    }

    public function addCursusContent(CursusContent $cursusContent): self
    {
        if (!$this->cursusContents->contains($cursusContent)) {
            $this->cursusContents[] = $cursusContent;
            $cursusContent->setCursus($this);
        }

        return $this;
    }

    public function removeCursusContent(CursusContent $cursusContent): self
    {
        if ($this->cursusContents->removeElement($cursusContent)) {
            // set the owning side to null (unless already changed)
            if ($cursusContent->getCursus() === $this) {
                $cursusContent->setCursus(null);
            }
        }

        return $this;
    }
}

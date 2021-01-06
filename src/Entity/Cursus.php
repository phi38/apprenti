<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CursusRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;

/**
 * @ORM\Entity(repositoryClass=CursusRepository::class)
 * @ApiResource(
 *  collectionOperations={
 *          "get" ={"path"="/cursus"}
 *      }, 
 *  itemOperations={
 *          "get" ={"path"="/cursus/{id}"}
 *      }
 * )
 * @ApiFilter(SearchFilter::class,  properties={"level":"exact"})
 * @ApiFilter(RangeFilter::class, properties={"level"})
 **/
class Cursus
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $level;

    /**
     * @ORM\Column(type="integer")
     */
    private $rights;

    /**
     * @ORM\Column(type="integer")
     */
    private $points;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $lastupdate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $theme;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $subtitle;

    /**
     * @ORM\OneToMany(targetEntity=CursusContent::class, mappedBy="cursusId", orphanRemoval=true)
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

    public function getNbComments(): ?int
    {
        return 0;
    }

    public function getNotation(): int
    {
        return 5;
    }

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

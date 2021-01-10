<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CoursRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;


/**
 * @ORM\Entity(repositoryClass=CoursRepository::class)
 * @ApiResource(
 *  collectionOperations={
 *          "get" ={
 *              "path"="/cours",
 *               "normalization_context"={"groups"={"courssimple:read"}} 
 *              }
 *      }, 
 *  itemOperations={
 *          "get" ={
 *              "path"="/cours/{id}",
 *              "normalization_context"={"groups"={"coursdetail:read","courssimple:read"}} ,
 *              }
 *      }
 * )
 */
class Cours
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"courssimple:read","cursusFolloweddetail:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"courssimple:read","cursusFolloweddetail:read"})
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups("coursdetail:read")
     */
    private $subtitle;

    /**
     * @ORM\Column(type="integer")
     * 
     * @Groups("courssimple:read")
     */
    private $level;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups("courssimple:read")
     */
    private $theme;

    /**
     * @ORM\Column(type="integer")
     * 
     * @Groups({"courssimple:read","cursusFolloweddetail:read"})
     */
    private $type;

    /**
     * @ORM\Column(type="json")
     * @Groups("cursusFolloweddetail:read")
     */
    private $content = [];

    /**
     * @ORM\Column(type="datetime_immutable")
     * 
     *  @Groups({"coursimple:read"})
     */
    private $lastupdate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups("coursdetail:read")
     */
    private $description;


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

    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    public function setSubtitle(?string $subtitle): self
    {
        $this->subtitle = $subtitle;

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

    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function setTheme(?string $theme): self
    {
        $this->theme = $theme;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getContent(): ?array
    {
        return $this->content;
    }

    public function setContent(array $content): self
    {
        $this->content = $content;

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
     * How long ago in text that this cheese listing was added.
     *
     * @Groups("courssimple:read")
     * 
     */
    public function getNbComments(): ?int
    {
        return 10;
    }

    /**
     * How long ago in text that this cheese listing was added.
     *
     * @Groups("courssimple:read")
     */
    public function getNotation(): int
    {
        return 5;
    }

    /**
     * How long ago in text that this cheese listing was added.
     *
     * @Groups("courssimple:read")
     */
    public function getNbrecord(): int
    {
        return 5;
    }
}

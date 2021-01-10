<?php

namespace App\Entity;


use App\Repository\CursusContentRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
/**
 * @ORM\Entity(repositoryClass=CursusContentRepository::class)
 * @ApiResource(
 *  collectionOperations={
 *          "get" ={
 *              "path"="/cursusContent",
 *               "normalization_context"={"groups"={"cursusContentsimple:read"}} 
 *              }
 *      }, 
 *  itemOperations={
 *          "get" ={
 *              "path"="/cursusContent/{id}",
 *              "normalization_context"={"groups"={"cursusContentdetail:read","cursusContentsimple:read"}} 
 *              }
 *      }
 * )
 * @ApiFilter(SearchFilter::class, properties={"cours": "exact"})
 */
class CursusContent
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @Groups({"cursusContentsimple:read","cursusFolloweddetail:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * 
     * @Groups("cursusContentsimple:read")
     */
    private $position;

    /**
     * @ORM\ManyToOne(targetEntity=Cursus::class, inversedBy="cursusContents")
     * @ORM\JoinColumn(nullable=false)
     * 
     * @Groups("cursusContentdetail:read")
     */
    private $cursus;

    /**
     * @ORM\ManyToOne(targetEntity=Cours::class)
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"cursusContentdetail:read","cursusFolloweddetail:read"})
     */
    private $cours;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(?int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getCursus(): ?Cursus
    {
        return $this->cursus;
    }

    public function setCursus(?Cursus $cursus): self
    {
        $this->cursus = $cursus;

        return $this;
    }

    public function getCours(): ?Cours
    {
        return $this->cours;
    }

    public function setCours(?Cours $cours): self
    {
        $this->cours = $cours;

        return $this;
    }
}

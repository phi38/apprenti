<?php

namespace App\Entity;

use App\Entity\Cursus;
use App\Entity\Profil;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CursusFollowedRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;



/**
 * @ORM\Entity(repositoryClass=CursusFollowedRepository::class)
 * @ApiResource(
 *  attributes={"filters"={"cursusfollowed.search_filter"},"pagination_enabled"=false},
 *  collectionOperations={
 *          "get" ={
 *              "path"="/cursusFollowed",
 *               "normalization_context"={"groups"={"cursusFolloweddetail:read","cursusFollowedsimple:read"}} 
 *              }
 *      }, 
 *  itemOperations={
 *          "get" ={
 *              "path"="/cursusFollowed/{id}",
 *               "normalization_context"={"groups"={"EMPTY"}},
 *              }
 *      }, 
 * )
 */
class CursusFollowed
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("cursusFollowedsimple:read")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Profil::class, inversedBy="cursusFollowed")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"cursusFollowedsimple:read","cursusFolloweddetail:read"})
     */
    private $profil;

    /**
     * @ORM\ManyToOne(targetEntity=Cursus::class)
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"cursusFollowedsimple:read","cursusFolloweddetail:read"})
     */
    private $cursus;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Groups("cursusFollowedsimple:read")
     */
    private $startDate;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     * @Groups("cursusFollowedsimple:read")
     */
    private $endDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProfil(): ?Profil
    {
        return $this->profil;
    }

    public function setProfil(?Profil $profil): self
    {
        $this->profil = $profil;

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

    public function getStartDate(): ?\DateTimeImmutable
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeImmutable $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeImmutable
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTimeImmutable $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }
}

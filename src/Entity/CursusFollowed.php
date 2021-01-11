<?php

namespace App\Entity;

use App\Entity\Cursus;
use App\Entity\Profil;
use App\Annotation\UserAware;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CursusFollowedRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;



/**
 * Secured resource.
 * 
 * @ApiResource(
 *  attributes={"filters"={"cursusfollowed.search_filter"},"pagination_enabled"=false},
 *  collectionOperations={
 *          "get" ={
 *              "path"="/cursusFollowed",               
 *              "normalization_context"={"groups"={"cursusFollowedsimple:read"}} ,
 *              }
 *      }, 
 *  itemOperations={
 *          "get" ={
 *              "path"="/cursusFollowed/{id}",
 *              "normalization_context"={"groups"={"cursusFolloweddetail:read","cursusFollowedsimple:read"}} ,
 *              "security"="object.getOwner() == user",
 *              }
 *      }, 
 * )
 * 
 * @ORM\Entity(repositoryClass=CursusFollowedRepository::class)
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

    
    /*
    * @Groups({"cursusFollowedsimple:read","cursusFolloweddetail:read"})
    */
    public function getOwner(): ?User
    {
        return $this->profil->getOwner();
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

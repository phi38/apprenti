<?php

namespace App\Entity;

use App\Entity\User;
use App\Entity\CursusFollowed;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProfilRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ORM\Entity(repositoryClass=ProfilRepository::class)
 * @ApiResource(
 *  collectionOperations={
 *          "get" ={
 *              "path"="/profil",
 *              "normalization_context"={"groups"={"profilsimple:read"}} 
 *             }
 *      }, 
 *  itemOperations={
 *          "get" ={
 *              "path"="/profil/{id}",
 *              "normalization_context"={"groups"={ "profil-detail:read", "profilsimple:read"}} 
 *              },
 *          "put" ={
 *              "path"="/profil/{id}"
 *             }
 *      },
 * )
 * @ApiFilter(SearchFilter::class,  properties={"level":"exact"})
 * @ApiFilter(DateFilter::class, properties={"lastupdate":"strictly_after"})
 */
class Profil
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"profilsimple:read"})
     */
    private $id;

    
    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     * @Groups({"profilsimple:read"})
     */
    private $pseudo;


    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"profilsimple:read"})
     */
    private $level;

    /**
     * @ORM\Column(type="string", length=8, nullable=true)
     */
    private $postal_code;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"profil-detail:read"})
     */
    private $equipment;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"profil-detail:read"})
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"profil-detail:read"})
     */
    private $objectif;

    /**
     * @ORM\Column(type="simple_array", nullable=true)
     */
    private $objectif_list = [];

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="profil", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $lastupdate;

    
    /**
     * @ORM\OneToMany(targetEntity=CursusFollowed::class, mappedBy="profil", orphanRemoval=true)
     */
    private $cursusFollowed;


    public function __construct()
    {
        $this->cursusFollowed = new ArrayCollection();
    }


    /**
     * @return Collection|CursusFollowed[]
     */
    public function getCursusFollowed(): Collection
    {
        return $this->cursusFollowed;
    }

    public function addCursusFollowed(CursusFollowed $cursusFollowed): self
    {
        if (!$this->cursusFollowed->contains($cursusFollowed)) {
            $this->cursusFollowed[] = $cursusFollowed;
            $cursusFollowed->setProfil($this);
        }

        return $this;
    }

    public function removeCursusFollowed(CursusFollowed $cursusFollowed): self
    {
        if ($this->cursusFollowed->removeElement($cursusFollowed)) {
            // set the owning side to null (unless already changed)
            if ($cursusFollowed->getProfil() === $this) {
                $cursusFollowed->setProfil(null);
            }
        }

        return $this;
    }
    

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPostalCode(): ?string
    {
        return $this->postal_code;
    }

    public function setPostalCode(?string $postal_code): self
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    public function getEquipment(): ?string
    {
        return $this->equipment;
    }

    public function setEquipment(?string $equipment): self
    {
        $this->equipment = $equipment;

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

    public function getObjectif(): ?string
    {
        return $this->objectif;
    }

    public function setObjectif(?string $objectif): self
    {
        $this->objectif = $objectif;

        return $this;
    }

    public function getObjectifList(): ?array
    {
        return $this->objectif_list;
    }

    public function setObjectifList(?array $objectif_list): self
    {
        $this->objectif_list = $objectif_list;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(User $owner): self
    {
        $this->owner = $owner;

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

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(?string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }
}

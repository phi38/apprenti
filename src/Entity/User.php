<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 * @ApiResource(
 *      collectionOperations={
 *          "post" ={"path"="/apprenti"},
 *      }, 
 *      itemOperations={
 *          "put" ={
 *                  "path"="/apprenti/{id}",
 *                  "normalizationContext"={"groups"={"apprenti:read","apprenti:write"}} 
 *                  }
 *      },
 *      normalizationContext={"groups"={"apprenti:read"}, "swagger_definition_name"="Read"},
 *      denormalizationContext={"groups"={"apprenti:write"}, "swagger_definition_name"="Write"},
 *      shortName="Apprenti"
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"apprenti:write"})
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Groups({"apprenti:write"})
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     * @Groups({"apprenti:write","apprenti:read"})
     */
    private $pseudo;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

    /**
     * @ORM\OneToOne(targetEntity=Profil::class, mappedBy="userId", cascade={"persist", "remove"})
     */
    private $profil;

    /**
     * @ORM\OneToMany(targetEntity=CursusFollowed::class, mappedBy="userId", orphanRemoval=true)
     */
    private $cursusFollowed;

    public function __construct()
    {
        $this->cursusFollowed = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getProfil(): ?Profil
    {
        return $this->profil;
    }

    public function setProfil(Profil $profil): self
    {
        // set the owning side of the relation if necessary
        if ($profil->getUser() !== $this) {
            $profil->setUser($this);
        }

        $this->profil = $profil;

        return $this;
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
            $cursusFollowed->setUser($this);
        }

        return $this;
    }

    public function removeCursusFollowed(CursusFollowed $cursusFollowed): self
    {
        if ($this->cursusFollowed->removeElement($cursusFollowed)) {
            // set the owning side to null (unless already changed)
            if ($cursusFollowed->getUser() === $this) {
                $cursusFollowed->setUser(null);
            }
        }

        return $this;
    }
}

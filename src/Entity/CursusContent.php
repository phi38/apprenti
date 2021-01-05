<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CursusContentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CursusContentRepository::class)
 * @ApiResource(
 *  collectionOperations={
 *          "get" ={"path"="/cursusContent"}
 *      }, 
 *  itemOperations={
 *          "get" ={"path"="/cursusContent/{id}"}
 *      }
 * )
 */
class CursusContent
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $position;

    /**
     * @ORM\ManyToOne(targetEntity=Cursus::class, inversedBy="cursusContents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cursusId;

    /**
     * @ORM\ManyToOne(targetEntity=Cours::class, inversedBy="cursusContents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $coursId;

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

    public function getCursusId(): ?Cursus
    {
        return $this->cursusId;
    }

    public function setCursusId(?Cursus $cursusId): self
    {
        $this->cursusId = $cursusId;

        return $this;
    }

    public function getCoursId(): ?Cours
    {
        return $this->coursId;
    }

    public function setCoursId(?Cours $coursId): self
    {
        $this->coursId = $coursId;

        return $this;
    }
}

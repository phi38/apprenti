<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\InfosNewsRepository;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=InfosNewsRepository::class)
 * @ApiResource(
 *  collectionOperations={
 *          "get" ={
 *              "path"="/infosNews",
 *              }
 *      }, 
 *  itemOperations={
 *          "get" ={
 *              "path"="/infosNews/{id}",
 *              }
 *      }
 * )
 */
class InfosNews
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
    private $type;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $message;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $startDate;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $endDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(?int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getStartDate(): ?\DateTimeImmutable
    {
        return $this->startDate;
    }

    public function setStartDate(?\DateTimeImmutable $startDate): self
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

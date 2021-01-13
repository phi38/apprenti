<?php

namespace App\Entity;

use App\Repository\ForbidenMachineRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ForbidenMachineRepository::class)
 */
class ForbidenMachine
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $machine;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ipAdress;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMachine(): ?string
    {
        return $this->machine;
    }

    public function setMachine(string $machine): self
    {
        $this->machine = $machine;

        return $this;
    }

    public function getIpAdress(): ?string
    {
        return $this->ipAdress;
    }

    public function setIpAdress(?string $ipAdress): self
    {
        $this->ipAdress = $ipAdress;

        return $this;
    }
}

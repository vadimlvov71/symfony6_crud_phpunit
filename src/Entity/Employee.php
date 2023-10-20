<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeeRepository::class)]
class Employee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]

    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $dateToBeHired = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $dataEntityCreated = null;

    #[ORM\Column(length: 255)]
    private ?string $dateEntityUpdated = null;

    #[ORM\Column(length: 255)]
    private ?string $currentSalary = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getDateToBeHired(): ?string
    {
        return $this->dateToBeHired;
    }

    public function setDateToBeHired(string $dateToBeHired): static
    {
        $this->dateToBeHired = $dateToBeHired;

        return $this;
    }

    public function getDataEntityCreated(): ?string
    {
        return $this->dataEntityCreated;
    }

    public function setDataEntityCreated(?string $dataEntityCreated): static
    {
        $this->dataEntityCreated = $dataEntityCreated;

        return $this;
    }

    public function getDateEntityUpdated(): ?string
    {
        return $this->dateEntityUpdated;
    }

    public function setDateEntityUpdated(string $dateEntityUpdated): static
    {
        $this->dateEntityUpdated = $dateEntityUpdated;

        return $this;
    }

    public function getCurrentSalary(): ?string
    {
        return $this->currentSalary;
    }

    public function setCurrentSalary(string $currentSalary): static
    {
        $this->currentSalary = $currentSalary;

        return $this;
    }
}

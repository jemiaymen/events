<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AttendeesRepository")
 */
class Attendees
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $FirstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $LastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Company;

    /**
     * @ORM\Column(type="string", length=90, nullable=true)
     */
    private $Tel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Country;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Job;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $Photo;

    /**
     * @ORM\Column(type="boolean")
     */
    private $CheckedIn;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AttendeeTypes", inversedBy="attendees")
     */
    private $Type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Events", inversedBy="attendees")
     */
    private $Event;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->FirstName;
    }

    public function setFirstName(string $FirstName): self
    {
        $this->FirstName = $FirstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->LastName;
    }

    public function setLastName(string $LastName): self
    {
        $this->LastName = $LastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->Company;
    }

    public function setCompany(?string $Company): self
    {
        $this->Company = $Company;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->Tel;
    }

    public function setTel(?string $Tel): self
    {
        $this->Tel = $Tel;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->Country;
    }

    public function setCountry(?string $Country): self
    {
        $this->Country = $Country;

        return $this;
    }

    public function getJob(): ?string
    {
        return $this->Job;
    }

    public function setJob(?string $Job): self
    {
        $this->Job = $Job;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->Photo;
    }

    public function setPhoto(?string $Photo): self
    {
        $this->Photo = $Photo;

        return $this;
    }

    public function getCheckedIn(): ?bool
    {
        return $this->CheckedIn;
    }

    public function setCheckedIn(bool $CheckedIn): self
    {
        $this->CheckedIn = $CheckedIn;

        return $this;
    }

    public function getType(): ?AttendeeTypes
    {
        return $this->Type;
    }

    public function setType(?AttendeeTypes $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getEvent(): ?Events
    {
        return $this->Event;
    }

    public function setEvent(?Events $Event): self
    {
        $this->Event = $Event;

        return $this;
    }
}

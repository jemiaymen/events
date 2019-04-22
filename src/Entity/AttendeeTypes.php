<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AttendeeTypesRepository")
 */
class AttendeeTypes
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
    private $Name;

    /**
     * @ORM\Column(type="float")
     */
    private $Price;

    /**
     * @ORM\Column(type="smallint")
     */
    private $AttendeeLimit;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $MinWorkshops;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $MaxWorkshops;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $Description;

    /**
     * @ORM\Column(type="boolean")
     */
    private $AllowEdit;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $AllowPublicRegistration;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Events", inversedBy="attendeeTypes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $TypeEvent;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Attendees", mappedBy="Type")
     */
    private $attendees;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Guest", mappedBy="Type", orphanRemoval=true)
     */
    private $guests;

    public function __construct()
    {
        $this->attendees = new ArrayCollection();
        $this->guests = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->Price;
    }

    public function setPrice(float $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    public function getAttendeeLimit(): ?int
    {
        return $this->AttendeeLimit;
    }

    public function setAttendeeLimit(int $AttendeeLimit): self
    {
        $this->AttendeeLimit = $AttendeeLimit;

        return $this;
    }

    public function getMinWorkshops(): ?int
    {
        return $this->MinWorkshops;
    }

    public function setMinWorkshops(?int $MinWorkshops): self
    {
        $this->MinWorkshops = $MinWorkshops;

        return $this;
    }

    public function getMaxWorkshops(): ?int
    {
        return $this->MaxWorkshops;
    }

    public function setMaxWorkshops(?int $MaxWorkshops): self
    {
        $this->MaxWorkshops = $MaxWorkshops;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getAllowEdit(): ?bool
    {
        return $this->AllowEdit;
    }

    public function setAllowEdit(bool $AllowEdit): self
    {
        $this->AllowEdit = $AllowEdit;

        return $this;
    }

    public function getAllowPublicRegistration(): ?bool
    {
        return $this->AllowPublicRegistration;
    }

    public function setAllowPublicRegistration(?bool $AllowPublicRegistration): self
    {
        $this->AllowPublicRegistration = $AllowPublicRegistration;

        return $this;
    }

    public function getTypeEvent(): ?Events
    {
        return $this->TypeEvent;
    }

    public function setTypeEvent(?Events $TypeEvent): self
    {
        $this->TypeEvent = $TypeEvent;

        return $this;
    }

    /**
     * @return Collection|Attendees[]
     */
    public function getAttendees(): Collection
    {
        return $this->attendees;
    }

    public function addAttendee(Attendees $attendee): self
    {
        if (!$this->attendees->contains($attendee)) {
            $this->attendees[] = $attendee;
            $attendee->setType($this);
        }

        return $this;
    }

    public function removeAttendee(Attendees $attendee): self
    {
        if ($this->attendees->contains($attendee)) {
            $this->attendees->removeElement($attendee);
            // set the owning side to null (unless already changed)
            if ($attendee->getType() === $this) {
                $attendee->setType(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Guest[]
     */
    public function getGuests(): Collection
    {
        return $this->guests;
    }

    public function addGuest(Guest $guest): self
    {
        if (!$this->guests->contains($guest)) {
            $this->guests[] = $guest;
            $guest->setType($this);
        }

        return $this;
    }

    public function removeGuest(Guest $guest): self
    {
        if ($this->guests->contains($guest)) {
            $this->guests->removeElement($guest);
            // set the owning side to null (unless already changed)
            if ($guest->getType() === $this) {
                $guest->setType(null);
            }
        }

        return $this;
    }
}

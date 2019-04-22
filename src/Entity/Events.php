<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventsRepository")
 */
class Events
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $Name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $StartDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $EndDate;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $Country;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     * @Assert\File(mimeTypes={ "image/png", "image/jpeg" })
     */
    private $Logo;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     * @Assert\File(mimeTypes={ "image/png", "image/jpeg" })
     */
    private $Banner;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $Language ;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $Location;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $Description;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $Budget;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $OwnerName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $OwnerMail;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Active;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Currency;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="events")
     * @ORM\JoinColumn(nullable=false)
     */
    private $UserEvent;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AttendeeTypes", mappedBy="TypeEvent", orphanRemoval=true)
     */
    private $attendeeTypes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Attendees", mappedBy="Event")
     */
    private $attendees;

    public function __construct()
    {
        $this->attendeeTypes = new ArrayCollection();
        $this->attendees = new ArrayCollection();
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

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->StartDate;
    }

    public function setStartDate(\DateTimeInterface $StartDate): self
    {
        $this->StartDate = $StartDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->EndDate;
    }

    public function setEndDate(\DateTimeInterface $EndDate): self
    {
        $this->EndDate = $EndDate;

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

    public function getLogo(): ?string
    {
        return $this->Logo;
    }

    public function setLogo(?string $Logo): self
    {
        $this->Logo = $Logo;

        return $this;
    }

    public function getBanner(): ?string
    {
        return $this->Banner;
    }

    public function setBanner(?string $Banner): self
    {
        $this->Banner = $Banner;

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->Language;
    }

    public function setLanguage(?string $Language): self
    {
        $this->Language = $Language;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->Location;
    }

    public function setLocation(?string $Location): self
    {
        $this->Location = $Location;

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

    public function getBudget(): ?float
    {
        return $this->Budget;
    }

    public function setBudget(?float $Budget): self
    {
        $this->Budget = $Budget;

        return $this;
    }

    public function getOwnerName(): ?string
    {
        return $this->OwnerName;
    }

    public function setOwnerName(string $OwnerName): self
    {
        $this->OwnerName = $OwnerName;

        return $this;
    }

    public function getOwnerMail(): ?string
    {
        return $this->OwnerMail;
    }

    public function setOwnerMail(string $OwnerMail): self
    {
        $this->OwnerMail = $OwnerMail;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->Active;
    }

    public function setActive(bool $Active): self
    {
        $this->Active = $Active;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->Currency;
    }

    public function setCurrency(?string $Currency): self
    {
        $this->Currency = $Currency;

        return $this;
    }

    public function getUserEvent(): ?User
    {
        return $this->UserEvent;
    }

    public function setUserEvent(?User $UserEvent): self
    {
        $this->UserEvent = $UserEvent;

        return $this;
    }

    /**
     * @return Collection|AttendeeTypes[]
     */
    public function getAttendeeTypes(): Collection
    {
        return $this->attendeeTypes;
    }

    public function addAttendeeType(AttendeeTypes $attendeeType): self
    {
        if (!$this->attendeeTypes->contains($attendeeType)) {
            $this->attendeeTypes[] = $attendeeType;
            $attendeeType->setTypeEvent($this);
        }

        return $this;
    }

    public function removeAttendeeType(AttendeeTypes $attendeeType): self
    {
        if ($this->attendeeTypes->contains($attendeeType)) {
            $this->attendeeTypes->removeElement($attendeeType);
            // set the owning side to null (unless already changed)
            if ($attendeeType->getTypeEvent() === $this) {
                $attendeeType->setTypeEvent(null);
            }
        }

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
            $attendee->setEvent($this);
        }

        return $this;
    }

    public function removeAttendee(Attendees $attendee): self
    {
        if ($this->attendees->contains($attendee)) {
            $this->attendees->removeElement($attendee);
            // set the owning side to null (unless already changed)
            if ($attendee->getEvent() === $this) {
                $attendee->setEvent(null);
            }
        }

        return $this;
    }


    public function __toString()
    {
        return $this->Name;
    }
}

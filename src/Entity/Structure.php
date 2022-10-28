<?php

namespace App\Entity;

use App\Repository\StructureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/** @UniqueEntity(
  * fields={"name"},
  * errorPath="name",
  * message="Une structure portant ce nom existe déjà."
  *)
*/
#[ORM\Entity(repositoryClass: StructureRepository::class)]
#[ApiResource()]
class Structure implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(length: 20)]
    private ?string $managerFirstname = null;

    #[ORM\Column(length: 20)]
    private ?string $managerLastname = null;

    #[ORM\Column(length: 100)]
    private ?string $email = null;

    #[ORM\Column(type: 'json')]
    private array $roles = [];

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column]
    private ?bool $active = false;

    #[ORM\Column]
    private ?bool $sellFood = false;

    #[ORM\Column]
    private ?bool $sellDrink = false;

    #[ORM\Column]
    private ?bool $sendNewsletter = false;

    #[ORM\Column]
    private ?bool $scheduleManagement = false;

    #[ORM\Column]
    private ?bool $privateLesson = false;

    #[ORM\ManyToOne(inversedBy: 'structures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TechnicalTeam $technicalTeamId = null;

    #[ORM\ManyToOne(inversedBy: 'structures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Partner $partnerId = null;

    #[ORM\OneToMany(mappedBy: 'structureId', targetEntity: ContactForm::class)]
    private Collection $contactForms;

    public function __construct()
    {
        $this->contactForms = new ArrayCollection();
    }

    /**
     * Transform to string function to template parnterConsult to have structure ref
     * 
     * @return string
     */
    public function __toString()
    {
        // return (string) $this->getId();
        return (string) $this->getName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getManagerFirstname(): ?string
    {
        return $this->managerFirstname;
    }

    public function setManagerFirstname(string $managerFirstname): self
    {
        $this->managerFirstname = $managerFirstname;

        return $this;
    }

    public function getManagerLastname(): ?string
    {
        return $this->managerLastname;
    }

    public function setManagerLastname(string $managerLastname): self
    {
        $this->managerLastname = $managerLastname;

        return $this;
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
    public function getUserIdentifier(): string
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
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function isSellFood(): ?bool
    {
        return $this->sellFood;
    }

    public function setSellFood(bool $sellFood): self
    {
        $this->sellFood = $sellFood;

        return $this;
    }

    public function isSellDrink(): ?bool
    {
        return $this->sellDrink;
    }

    public function setSellDrink(bool $sellDrink): self
    {
        $this->sellDrink = $sellDrink;

        return $this;
    }

    public function isSendNewsletter(): ?bool
    {
        return $this->sendNewsletter;
    }

    public function setSendNewsletter(bool $sendNewsletter): self
    {
        $this->sendNewsletter = $sendNewsletter;

        return $this;
    }

    public function isScheduleManagement(): ?bool
    {
        return $this->scheduleManagement;
    }

    public function setScheduleManagement(bool $scheduleManagement): self
    {
        $this->scheduleManagement = $scheduleManagement;

        return $this;
    }

    public function isPrivateLesson(): ?bool
    {
        return $this->privateLesson;
    }

    public function setPrivateLesson(bool $privateLesson): self
    {
        $this->privateLesson = $privateLesson;

        return $this;
    }

    public function getTechnicalTeamId(): ?TechnicalTeam
    {
        return $this->technicalTeamId;
    }

    public function setTechnicalTeamId(?TechnicalTeam $technicalTeamId): self
    {
        $this->technicalTeamId = $technicalTeamId;

        return $this;
    }

    public function getPartnerId(): ?Partner
    {
        return $this->partnerId;
    }

    public function setPartnerId(?Partner $partnerId): self
    {
        $this->partnerId = $partnerId;

        return $this;
    }

    /**
     * @return Collection<int, ContactForm>
     */
    public function getContactForms(): Collection
    {
        return $this->contactForms;
    }

    public function addContactForm(ContactForm $contactForm): self
    {
        if (!$this->contactForms->contains($contactForm)) {
            $this->contactForms->add($contactForm);
            $contactForm->setStructureId($this);
        }

        return $this;
    }

    public function removeContactForm(ContactForm $contactForm): self
    {
        if ($this->contactForms->removeElement($contactForm)) {
            // set the owning side to null (unless already changed)
            if ($contactForm->getStructureId() === $this) {
                $contactForm->setStructureId(null);
            }
        }

        return $this;
    }
}

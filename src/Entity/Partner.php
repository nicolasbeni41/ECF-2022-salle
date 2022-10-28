<?php

namespace App\Entity;

use App\Repository\PartnerRepository;
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
  * message="Un partenaire portant ce nom existe déjà."
  *)
*/
#[ORM\Entity(repositoryClass: PartnerRepository::class)]
#[ApiResource()]
class Partner implements PasswordAuthenticatedUserInterface, UserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(length: 100)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(type: 'json')]
    private array $roles = [];
    
    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column]
    private ?bool $active = false;

    #[ORM\Column(type: 'text')]
    private ?string $description = null;

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

    #[ORM\ManyToOne(inversedBy: 'partners')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TechnicalTeam $technicalTeamId = null;

    #[ORM\OneToMany(mappedBy: 'partnerId', targetEntity: Structure::class)]
    private Collection $structures;

    #[ORM\OneToMany(mappedBy: 'partnerId', targetEntity: ContactForm::class)]
    private Collection $contactForms;

    /**
     * Transform to string function to template new structure to have partner name
     * 
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getName();
    }

    public function __construct()
    {
        $this->structures = new ArrayCollection();
        $this->contactForms = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    /**
     * @return Collection<int, Structure>
     */
    public function getStructures(): Collection
    {
        return $this->structures;
    }

    public function addStructure(Structure $structure): self
    {
        if (!$this->structures->contains($structure)) {
            $this->structures->add($structure);
            $structure->setPartnerId($this);
        }

        return $this;
    }

    public function removeStructure(Structure $structure): self
    {
        if ($this->structures->removeElement($structure)) {
            // set the owning side to null (unless already changed)
            if ($structure->getPartnerId() === $this) {
                $structure->setPartnerId(null);
            }
        }

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
            $contactForm->setPartnerId($this);
        }

        return $this;
    }

    public function removeContactForm(ContactForm $contactForm): self
    {
        if ($this->contactForms->removeElement($contactForm)) {
            // set the owning side to null (unless already changed)
            if ($contactForm->getPartnerId() === $this) {
                $contactForm->setPartnerId(null);
            }
        }

        return $this;
    }
}

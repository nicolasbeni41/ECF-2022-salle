<?php

namespace App\Entity;

use App\Repository\TechnicalTeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Annotation\ApiResource;

#[ORM\Entity(repositoryClass: TechnicalTeamRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'Cette adresse mail est utilisée pour un autre compte utilisateur')]
#[ApiResource()]
class TechnicalTeam implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $firstname = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $lastname = null;

    #[ORM\OneToMany(mappedBy: 'technicalTeamId', targetEntity: Partner::class)]
    private Collection $partners;

    #[ORM\OneToMany(mappedBy: 'technicalTeamId', targetEntity: Structure::class)]
    private Collection $structures;

    #[ORM\OneToMany(mappedBy: 'technicalTeamId', targetEntity: ContactForm::class)]
    private Collection $contactForms;

    public function __construct()
    {
        $this->partners = new ArrayCollection();
        $this->structures = new ArrayCollection();
        $this->contactForms = new ArrayCollection();
    }

    /**
     * Transform to string function to template new partner to have TechnicalTeam name
     * 
     * @return string
     */
    public function __toString()
    {
        $fullname = $this->getFirstname() .' '. $this->getLastName();
        return (string) $fullname;
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
    public function getPassword(): string
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

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return Collection<int, Partner>
     */
    public function getPartners(): Collection
    {
        return $this->partners;
    }

    public function addPartner(Partner $partner): self
    {
        if (!$this->partners->contains($partner)) {
            $this->partners->add($partner);
            $partner->setTechnicalTeamId($this);
        }

        return $this;
    }

    public function removePartner(Partner $partner): self
    {
        if ($this->partners->removeElement($partner)) {
            // set the owning side to null (unless already changed)
            if ($partner->getTechnicalTeamId() === $this) {
                $partner->setTechnicalTeamId(null);
            }
        }

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
            $structure->setTechnicalTeamId($this);
        }

        return $this;
    }

    public function removeStructure(Structure $structure): self
    {
        if ($this->structures->removeElement($structure)) {
            // set the owning side to null (unless already changed)
            if ($structure->getTechnicalTeamId() === $this) {
                $structure->setTechnicalTeamId(null);
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
            $contactForm->setTechnicalTeamId($this);
        }

        return $this;
    }

    public function removeContactForm(ContactForm $contactForm): self
    {
        if ($this->contactForms->removeElement($contactForm)) {
            // set the owning side to null (unless already changed)
            if ($contactForm->getTechnicalTeamId() === $this) {
                $contactForm->setTechnicalTeamId(null);
            }
        }

        return $this;
    }
}

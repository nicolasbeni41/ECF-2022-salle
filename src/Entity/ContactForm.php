<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ContactFormRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContactFormRepository::class)]
#[ApiResource]
class ContactForm
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\ManyToOne(inversedBy: 'contactForms')]
    private ?Structure $structureId = null;

    #[ORM\ManyToOne(inversedBy: 'contactForms')]
    private ?Partner $partnerId = null;

    #[ORM\ManyToOne(inversedBy: 'contactForms')]
    private ?TechnicalTeam $technicalTeamId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getStructureId(): ?Structure
    {
        return $this->structureId;
    }

    public function setStructureId(?Structure $structureId): self
    {
        $this->structureId = $structureId;

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

    public function getTechnicalTeamId(): ?TechnicalTeam
    {
        return $this->technicalTeamId;
    }

    public function setTechnicalTeamId(?TechnicalTeam $technicalTeamId): self
    {
        $this->technicalTeamId = $technicalTeamId;

        return $this;
    }
}

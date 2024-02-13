<?php

namespace App\Entity;

use App\Repository\AvisRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: AvisRepository::class)]
#[Broadcast]
class Avis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_user = null;

    #[ORM\Column(length: 255)]
    private ?string $date_creation = null;

    #[ORM\Column]
    private ?int $note = null;

    #[ORM\Column(length: 255)]
    private ?string $descriptif_avis = null;

    #[ORM\Column(length: 255)]
    private ?string $moderation_status = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomUser(): ?string
    {
        return $this->nom_user;
    }

    public function setNomUser(string $nom_user): static
    {
        $this->nom_user = $nom_user;

        return $this;
    }

    public function getDateCreation(): ?string
    {
        return $this->date_creation;
    }

    public function setDateCreation(string $date_creation): static
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getDescriptifAvis(): ?string
    {
        return $this->descriptif_avis;
    }

    public function setDescriptifAvis(string $descriptif_avis): static
    {
        $this->descriptif_avis = $descriptif_avis;

        return $this;
    }

    public function getModerationStatus(): ?string
    {
        return $this->moderation_status;
    }

    public function setModerationStatus(string $moderation_status): static
    {
        $this->moderation_status = $moderation_status;

        return $this;
    }
}

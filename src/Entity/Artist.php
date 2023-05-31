<?php

namespace App\Entity;

use App\Repository\ArtistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ArtistRepository::class)]
#[ORM\Table(name: "artists")]
class Artist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    #[Assert\Length(
        min: 2,
        max: 60,
        minMessage: "Le prénom doit comporter au moins {{ limit }} caractères",
        maxMessage: "Le prénom ne peut pas comporter plus de {{ limit }} caractères"
    )]
    private ?string $firstname = null;

    #[ORM\Column(length: 60)]
    #[Assert\Length(
        min: 2,
        max: 60,
        minMessage: "Le nom doit comporter au moins {{ limit }} caractères",
        maxMessage: "Le nom ne peut pas comporter plus de {{ limit }} caractères"
    )]
    private ?string $lastname = null;

    #[ORM\OneToMany(targetEntity: ArtistType::class, mappedBy: 'artist', orphanRemoval: true)]
    private Collection $types;

    public function __construct()
    {
        $this->types = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return Collection<int, ArtistType>
     */
    public function getTypes(): Collection
    {
        return $this->types;
    }

    public function addType(ArtistType $type): self
    {
        if (!$this->types->contains($type)) {
            $this->types->add($type);
            $type->setArtist($this);
        }

        return $this;
    }

    public function removeType(ArtistType $type): self
    {
        if ($this->types->removeElement($type)) {
            if ($type->getArtist() === $this) {
                $type->setArtist(null);
            }
        }

        return $this;
    }
}

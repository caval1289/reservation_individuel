<?php

namespace App\Entity;

use App\Repository\RepresentationUserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RepresentationUserRepository::class)]
/**
 * @ORM\Table(
 *     name="representation_user",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(
 *             name="representation_user_idx",
 *             columns={"representation_id", "user_id"}
 *         )
 *     }
 * )
 * @UniqueEntity(
 *     fields={"representation", "user"},
 *     message="This representation is already defined for this user of job in the database."
 * )
 */
class RepresentationUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Representation::class, inversedBy: 'representationUsers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Representation $representation = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'representationUsers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column]
    private ?int $places = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRepresentation(): ?Representation
    {
        return $this->representation;
    }

    public function setRepresentation(?Representation $representation): self
    {
        $this->representation = $representation;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getPlaces(): ?int
    {
        return $this->places;
    }

    public function setPlaces(int $places): self
    {
        $this->places = $places;

        return $this;
    }
}

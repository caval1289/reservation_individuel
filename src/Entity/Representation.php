<?php

namespace App\Entity;

use App\Repository\RepresentationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\JoinColumn;

#[ORM\Entity(repositoryClass: RepresentationRepository::class)]
#[ORM\Table(name:"representations")]
class Representation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Show::class, inversedBy: 'representations')]
    #[ORM\JoinColumn(nullable: false, name:'show_id', referencedColumnName: 'id', onDelete:'RESTRICT')]
    private ?Show $the_show = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $schedule = null;

    #[ORM\ManyToOne(targetEntity:Location::class, inversedBy: 'representations')]
    #[ORM\JoinColumn(name:'location_id', referencedColumnName:'id', onDelete:'RESTRICT')]
    private ?Location $the_location = null;

    #[ORM\OneToMany(mappedBy: 'representations', targetEntity: RepresentationUser::class, orphanRemoval:true)]
    private Collection $representationUsers;

    public function __construct()
    {

        $this->representationUsers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTheShow(): ?Show
    {
        return $this->the_show;
    }

    public function setTheShow(?Show $the_show): self
    {
        $this->the_show = $the_show;

        return $this;
    }

    public function getSchedule(): ?\DateTimeInterface
    {
        return $this->schedule;
    }

    public function setSchedule(\DateTimeInterface $schedule): self
    {
        $this->schedule = $schedule;

        return $this;
    }

    public function getTheLocation(): ?Location
    {
        return $this->the_location;
    }

    public function setTheLocation(?Location $the_location): self
    {
        $this->the_location = $the_location;

        return $this;
    }

     /**
     * @return Collection<int, RepresentationUser>
     */
    public function getRepresentationUser(): Collection
    {
        return $this->representationUsers;
    }

    public function addRepresentationUser(RepresentationUser $user): self
    {
        if (!$this->representationUsers->contains($user)) {
            $this->representationUsers->add($user);
            $user->setRepresentation($this);
        }

        return $this;
    }

    public function removeRepresentationUser(RepresentationUser $user): self
    {
        if ($this->representationUsers->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getRepresentation() === $this) {
                $user->setRepresentation(null);
            }
        }

        return $this;
    }
}

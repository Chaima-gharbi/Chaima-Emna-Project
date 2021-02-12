<?php

namespace App\Entity;

use App\Repository\EmprunteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmprunteRepository::class)
 */
class Emprunte
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     * @ORM\ManyToMany(targetEntity=Livre::class, inversedBy="empruntes")
     */

    private $livres;



    /**
     * @ORM\Column(type="date")
     */
    private $dateRetour;

    /**
     * @ORM\Column(type="date")
     */
    private $dateEmprunte;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="empruntes")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $etat;


    public function __construct()
    {
        $this->livres = new ArrayCollection();

    }
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }


    /**
     * @return Collection|livre[]
     */
    public function getLivres(): Collection
    {
        return $this->livres;
    }
    public function addLivre(livre $livre): self
    {
        if (!$this->livres->contains($livre)) {
            $this->livres[] = $livre;
        }

        return $this;
    }

    public function removeLivre(livre $livre): self
    {
        $this->livres->removeElement($livre);

        return $this;
    }


    public function getDateEmprunte(): ?\DateTimeInterface
    {
        return $this->dateEmprunte;
    }

    public function setDateEmprunte(\DateTimeInterface $dateEmprunte): self
    {
        $this->dateEmprunte = $dateEmprunte;

        return $this;
    }

    public function getDateRetour(): ?\DateTimeInterface
    {
        return $this->dateRetour;
    }

    public function setDateRetour(\DateTimeInterface $dateRetour): self
    {
        $this->dateRetour = $dateRetour;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }


}

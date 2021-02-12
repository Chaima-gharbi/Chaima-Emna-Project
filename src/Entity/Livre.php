<?php

namespace App\Entity;

use App\Repository\LivreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=LivreRepository::class)
 */
class Livre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=155)
     */
    private $titre;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbpages;

    /**
     * @ORM\Column(type="date")
     */
    private $dateedition;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrexemplaires;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="bigint")
     */
    private $isbn;

    /**
     * @ORM\ManyToOne(targetEntity=Editeur::class, inversedBy="livres")
     */
    private $editeur;


    /**
     * @ORM\ManyToMany(targetEntity=Auteur::class, inversedBy="livres")
     */
    private $auteurs;

    /**
     * @ORM\ManyToMany(targetEntity=Emprunte::class, mappedBy="livres", orphanRemoval=true)
     */
    private $empruntes;


    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="livres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Please choose image")
     * @Assert\File(mimeTypes={"image/jpeg"})
     */
    private $Photo;

    public function __construct()
    {
        $this->auteurs = new ArrayCollection();
        $this->empruntes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getNbpages(): ?int
    {
        return $this->nbpages;
    }

    public function setNbpages(int $nbpages): self
    {
        $this->nbpages = $nbpages;

        return $this;
    }

    public function getDateedition(): ?\DateTimeInterface
    {
        return $this->dateedition;
    }

    public function setDateedition(\DateTimeInterface $dateedition): self
    {
        $this->dateedition = $dateedition;

        return $this;
    }

    public function getNbrexemplaires(): ?int
    {
        return $this->nbrexemplaires;
    }

    public function setNbrexemplaires(int $nbrexemplaires): self
    {
        $this->nbrexemplaires = $nbrexemplaires;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(string $isbn): self
    {
        $this->isbn = $isbn;

        return $this;
    }

    public function getEditeur(): ?Editeur
    {
        return $this->editeur;
    }

    public function setEditeur(Editeur $editeur): self
    {
        $this->editeur = $editeur;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection|auteur[]
     */
    public function getAuteurs(): Collection
    {
        return $this->auteurs;
    }

    public function addAuteur(auteur $auteur): self
    {
        if (!$this->auteurs->contains($auteur)) {
            $this->auteurs[] = $auteur;
        }

        return $this;
    }

    public function removeAuteur(auteur $auteur): self
    {
        $this->auteurs->removeElement($auteur);

        return $this;
    }

    /**
     * @return Collection|Emprunte[]
     */
    public function getEmpruntes(): Collection
    {
        return $this->empruntes;
    }

    public function addEmprunte(Emprunte $emprunte): self
    {
        if (!$this->empruntes->contains($emprunte)) {
            $this->empruntes[] = $emprunte;
            $emprunte->setLivre($this);
        }

        return $this;
    }

    public function removeEmprunte(Emprunte $emprunte): self
    {
        if ($this->empruntes->removeElement($emprunte)) {
            // set the owning side to null (unless already changed)
            if ($emprunte->getLivre() === $this) {
                $emprunte->setLivre(null);
            }
        }

        return $this;
    }

    public function getPhoto()
    {
        return $this->Photo;
    }

    public function setPhoto($Photo)
    {
        $this->Photo = $Photo;

        return $this;
    }



}

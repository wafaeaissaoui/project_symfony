<?php

namespace App\Entity;

use App\Repository\PanierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PanierRepository::class)
 */
class Panier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="panier")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Paiement::class, mappedBy="panier")
     */
    private $paiement;

    /**
     * @ORM\OneToMany(targetEntity=ArticlePanier::class, mappedBy="panier")
     */
    private $articlePanier;

    public function __construct()
    {
        $this->paiement = new ArrayCollection();
        $this->articlePanier = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|Paiement[]
     */
    public function getPaiement(): Collection
    {
        return $this->paiement;
    }

    public function addPaiement(Paiement $paiement): self
    {
        if (!$this->paiement->contains($paiement)) {
            $this->paiement[] = $paiement;
            $paiement->setPanier($this);
        }

        return $this;
    }

    public function removePaiement(Paiement $paiement): self
    {
        if ($this->paiement->contains($paiement)) {
            $this->paiement->removeElement($paiement);
            // set the owning side to null (unless already changed)
            if ($paiement->getPanier() === $this) {
                $paiement->setPanier(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ArticlePanier[]
     */
    public function getArticlePanier(): Collection
    {
        return $this->articlePanier;
    }

    public function addArticlePanier(ArticlePanier $articlePanier): self
    {
        if (!$this->articlePanier->contains($articlePanier)) {
            $this->articlePanier[] = $articlePanier;
            $articlePanier->setPanier($this);
        }

        return $this;
    }

    public function removeArticlePanier(ArticlePanier $articlePanier): self
    {
        if ($this->articlePanier->contains($articlePanier)) {
            $this->articlePanier->removeElement($articlePanier);
            // set the owning side to null (unless already changed)
            if ($articlePanier->getPanier() === $this) {
                $articlePanier->setPanier(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="article")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomArticle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imageArticle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantiteEnStock;

    /**
     * @ORM\OneToMany(targetEntity=Offre::class, mappedBy="article")
     */
    private $offre;

    /**
     * @ORM\OneToMany(targetEntity=ArticlePanier::class, mappedBy="article")
     */
    private $articlePanier;

    public function __construct()
    {
        $this->offre = new ArrayCollection();
        $this->articlePanier = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getNomArticle(): ?string
    {
        return $this->nomArticle;
    }

    public function setNomArticle(string $nomArticle): self
    {
        $this->nomArticle = $nomArticle;

        return $this;
    }

    public function getImageArticle(): ?string
    {
        return $this->imageArticle;
    }

    public function setImageArticle(string $imageArticle): self
    {
        $this->imageArticle = $imageArticle;

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

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getQuantiteEnStock(): ?int
    {
        return $this->quantiteEnStock;
    }

    public function setQuantiteEnStock(int $quantiteEnStock): self
    {
        $this->quantiteEnStock = $quantiteEnStock;

        return $this;
    }

    /**
     * @return Collection|Offre[]
     */
    public function getOffre(): Collection
    {
        return $this->offre;
    }

    public function addOffre(Offre $offre): self
    {
        if (!$this->offre->contains($offre)) {
            $this->offre[] = $offre;
            $offre->setArticle($this);
        }

        return $this;
    }

    public function removeOffre(Offre $offre): self
    {
        if ($this->offre->contains($offre)) {
            $this->offre->removeElement($offre);
            // set the owning side to null (unless already changed)
            if ($offre->getArticle() === $this) {
                $offre->setArticle(null);
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
            $articlePanier->setArticle($this);
        }

        return $this;
    }

    public function removeArticlePanier(ArticlePanier $articlePanier): self
    {
        if ($this->articlePanier->contains($articlePanier)) {
            $this->articlePanier->removeElement($articlePanier);
            // set the owning side to null (unless already changed)
            if ($articlePanier->getArticle() === $this) {
                $articlePanier->setArticle(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return (string) $this->nomArticle;
    }
}

<?php

namespace Starkerxp\EcommerceBundle\Services\Command\Produit;

use \Starkerxp\CQRSESBundle\Services\Command\CommandInterface;

class CreerProduitCommand implements CommandInterface
{

    private $libelle;
    private $description;
    private $prix;
    private $quantite;
    private $marqueId;
    private $images;

    /**
     * @return mixed
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function getPrix()
    {
        return $this->prix;
    }

    public function setPrix($prix)
    {
        $this->prix = $prix;
        return $this;
    }

    public function getQuantite()
    {
        return $this->quantite;
    }

    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
        return $this;
    }

    public function getMarqueId()
    {
        return $this->marqueId;
    }

    public function setMarqueId($marqueId)
    {
        $this->marqueId = $marqueId;
        return $this;
    }

    public function getImages()
    {
        return $this->images;
    }

    public function setImages($images)
    {
        $this->images = $images;
        return $this;
    }

}

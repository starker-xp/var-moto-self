<?php

namespace Starkerxp\EcommerceBundle\Services\Domain\Produit;

class ProduitDTO
{

    private $id;
    private $marque;
    private $libelle;
    private $description;
    private $prix;
    private $quantite;
    private $sku;

    public function __construct($id, $marque, $libelle, $description, $prix, $quantite, $sku)
    {
        $this->id = $id;
        $this->marque = $marque;
        $this->libelle = $libelle;
        $this->description = $description;
        $this->prix = $prix;
        $this->quantite = $quantite;
        $this->sku = $sku;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getLibelle()
    {
        return $this->libelle;
    }

    public function getMarque()
    {
        return $this->marque;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPrix()
    {
        return $this->prix;
    }

    public function getQuantite()
    {
        return $this->quantite;
    }

    public function getSku()
    {
        return $this->sku;
    }

}

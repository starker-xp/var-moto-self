<?php

namespace Starkerxp\EcommerceBundle\Services\Domain\Produit;

use Starkerxp\CQRSESBundle\Services\Domain\DTOInterface;

class ProduitDTO implements DTOInterface
{

    private $id;
    private $marqueId;
    private $libelle;
    private $description;
    private $prix;
    private $quantite;
    private $sku;

    public function __construct($id, $marqueId, $libelle, $description, $prix, $quantite, $sku)
    {
        $this->id = $id;
        $this->marqueId = $marqueId;
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

    public function getMarqueId()
    {
        return $this->marqueId;
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

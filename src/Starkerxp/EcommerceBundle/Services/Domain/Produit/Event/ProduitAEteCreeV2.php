<?php

namespace Starkerxp\EcommerceBundle\Services\Domain\Produit\Event;

use \Starkerxp\CQRSESBundle\Services\Domain\AbstractEvent;

class ProduitAEteCreeV2 extends AbstractEvent
{

    private $produitId;
    private $libelle;
    private $description;
    private $prix;
    private $quantite;
    private $marqueId;

    public function __construct($produitId, $marqueId, $libelle, $description, $prix, $quantite)
    {
        $this->produitId = $produitId;
        $this->marqueId = $marqueId;
        $this->libelle = $libelle;
        $this->description = $description;
        $this->prix = $prix;
        $this->quantite = $quantite;
        $this->version = 1;
    }

    public function getAggregateId()
    {
        return $this->produitId;
    }

    public function getLibelle()
    {
        return $this->libelle;
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

    public function getMarqueId()
    {
        return $this->marqueId;
    }

}

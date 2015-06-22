<?php

namespace Starkerxp\EcommerceBundle\Services\Domain\Produit\Event;

use \Starkerxp\CQRSESBundle\Services\Domain\EventInterface;

class MarqueAEteCree implements EventInterface
{

    private $produitId;
    private $libelle;
    private $description;
    private $prix;
    private $quantite;
    //
    private $marque;

    public function __construct($produitId, $marque, $libelle, $description, $prix, $quantite)
    {
        $this->produitId = $produitId;
        $this->marque = $marque;
        $this->libelle = $libelle;
        $this->description = $description;
        $this->prix = $prix;
        $this->quantite = $quantite;
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

    public function getMarque()
    {
        return $this->marque;
    }

}

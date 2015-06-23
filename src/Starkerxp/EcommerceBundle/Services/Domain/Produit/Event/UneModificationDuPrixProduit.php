<?php

namespace Starkerxp\EcommerceBundle\Services\Domain\Produit\Event;

use \Starkerxp\CQRSESBundle\Services\Domain\EventInterface;

class UneModificationDuPrixProduit implements EventInterface
{

    private $produitId;
    private $prix;

    public function __construct($produitId, $prix)
    {
        $this->produitId = $produitId;
        $this->prix = $prix;
    }

    public function getAggregateId()
    {
        return $this->produitId;
    }

    public function getPrix()
    {
        return $this->prix;
    }

}

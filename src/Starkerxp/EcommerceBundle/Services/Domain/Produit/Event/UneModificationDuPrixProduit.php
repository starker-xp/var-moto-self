<?php

namespace Starkerxp\EcommerceBundle\Services\Domain\Produit\Event;

use \Starkerxp\CQRSESBundle\Services\Domain\AbstractEvent;

class UneModificationDuPrixProduit extends AbstractEvent
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

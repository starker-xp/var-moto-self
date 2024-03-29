<?php

namespace Starkerxp\EcommerceBundle\Services\Domain\Produit\Event;

use \Starkerxp\CQRSESBundle\Services\Domain\AbstractEvent;

class UneModificationDeLaQuantiteProduit extends AbstractEvent
{

    private $produitId;
    private $quantite;

    public function __construct($produitId, $quantite)
    {
        $this->produitId = $produitId;
        $this->quantite = $quantite;
    }

    public function getAggregateId()
    {
        return $this->produitId;
    }

    public function getQuantite()
    {
        return $this->quantite;
    }

}

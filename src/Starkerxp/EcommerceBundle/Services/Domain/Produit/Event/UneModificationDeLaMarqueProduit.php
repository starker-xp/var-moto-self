<?php

namespace Starkerxp\EcommerceBundle\Services\Domain\Produit\Event;

use \Starkerxp\CQRSESBundle\Services\Domain\AbstractEvent;

class UneModificationDeLaMarqueProduit extends AbstractEvent
{

    private $produitId;
    private $marqueId;

    public function __construct($produitId, $marqueId)
    {
        $this->produitId = $produitId;
        $this->marqueId = $marqueId;
    }

    public function getAggregateId()
    {
        return $this->produitId;
    }

}

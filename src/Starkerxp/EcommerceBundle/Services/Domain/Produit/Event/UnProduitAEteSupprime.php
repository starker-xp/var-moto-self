<?php

namespace Starkerxp\EcommerceBundle\Services\Domain\Produit\Event;

use \Starkerxp\CQRSESBundle\Services\Domain\EventInterface;

class UnProduitAEteSupprime implements EventInterface
{

    private $produitId;

    public function __construct($produitId)
    {
        $this->produitId = $produitId;
    }

    public function getAggregateId()
    {
        return $this->produitId;
    }

}

<?php

namespace Starkerxp\EcommerceBundle\Services\Domain\Produit\Event;

use \Starkerxp\CQRSESBundle\Services\Domain\EventInterface;

class UneModificationDeLaDescriptionProduit implements EventInterface
{

    private $produitId;
    private $description;

    public function __construct($produitId, $description)
    {
        $this->produitId = $produitId;
        $this->description = $description;
    }

    public function getAggregateId()
    {
        return $this->produitId;
    }

    public function getDescription()
    {
        return $this->description;
    }

}

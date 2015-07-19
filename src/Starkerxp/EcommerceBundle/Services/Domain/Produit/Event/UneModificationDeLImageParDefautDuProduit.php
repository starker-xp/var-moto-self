<?php

namespace Starkerxp\EcommerceBundle\Services\Domain\Produit\Event;

use \Starkerxp\CQRSESBundle\Services\Domain\AbstractEvent;

class UneModificationDeLImageParDefautDuProduit extends AbstractEvent
{

    private $produitId;
    private $imagesParDefaut;

    public function __construct($produitId, $imagesParDefaut)
    {
        $this->produitId = $produitId;
        $this->imagesParDefaut = $imagesParDefaut;
    }

    public function getAggregateId()
    {
        return $this->produitId;
    }

    public function getImagesParDefaut()
    {
        return $this->imagesParDefaut;
    }

}

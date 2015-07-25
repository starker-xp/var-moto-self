<?php

namespace Starkerxp\EcommerceBundle\Services\Domain\Produit\Event;

use \Starkerxp\CQRSESBundle\Services\Domain\AbstractEvent;

class UneImageProduitAEteSupprime extends AbstractEvent
{

    private $produitId;
    private $imageProduitId;
    private $repertoire;

    public function __construct($produitId, $imagesProduitId, $repertoire)
    {
        $this->produitId = $produitId;
        $this->imageProduitId = $imagesProduitId;
        $this->repertoire = $repertoire;
    }

    public function getAggregateId()
    {
        return $this->produitId;
    }

    public function getImageProduitId()
    {
        return $this->imageProduitId;
    }

    public function getRepertoire()
    {
        return $this->repertoire;
    }

}

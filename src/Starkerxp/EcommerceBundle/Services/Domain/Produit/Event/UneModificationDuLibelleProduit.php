<?php

namespace Starkerxp\EcommerceBundle\Services\Domain\Produit\Event;

use \Starkerxp\CQRSESBundle\Services\Domain\EventInterface;

class UneModificationDuLibelleProduit implements EventInterface
{

    private $produitId;
    private $libelle;

    public function __construct($produitId, $libelle)
    {
        $this->produitId = $produitId;
        $this->libelle = $libelle;
    }

    public function getAggregateId()
    {
        return $this->produitId;
    }

    public function getLibelle()
    {
        return $this->libelle;
    }

}

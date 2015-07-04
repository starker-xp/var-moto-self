<?php

namespace Starkerxp\EcommerceBundle\Services\Domain\Marque\Event;

use \Starkerxp\CQRSESBundle\Services\Domain\AbstractEvent;

class MarqueAEteCree extends AbstractEvent
{

    private $marqueId;
    private $libelle;

    public function __construct($marqueId, $libelle)
    {
        $this->marqueId = $marqueId;
        $this->libelle = $libelle;
    }

    public function getAggregateId()
    {
        return $this->marqueId;
    }

    public function getLibelle()
    {
        return $this->libelle;
    }

}

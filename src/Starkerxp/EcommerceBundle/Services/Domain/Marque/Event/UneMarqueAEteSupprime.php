<?php

namespace Starkerxp\EcommerceBundle\Services\Domain\Marque\Event;

use \Starkerxp\CQRSESBundle\Services\Domain\AbstractEvent;

class UneMarqueAEteSupprime extends AbstractEvent
{

    private $marqueId;

    public function __construct($marqueId)
    {
        $this->marqueId = $marqueId;
    }

    public function getAggregateId()
    {
        return $this->marqueId;
    }

}

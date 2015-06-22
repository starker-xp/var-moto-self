<?php

namespace Starkerxp\EcommerceBundle\Services\Domain\Marque\Event;

use \Starkerxp\CQRSESBundle\Services\Domain\EventInterface;

class UneMarqueAEteSupprime implements EventInterface
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

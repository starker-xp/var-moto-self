<?php

namespace Starkerxp\EcommerceBundle\Services\Persistence\Marque\Write;

use \Starkerxp\EcommerceBundle\Services\Domain\Marque\MarqueDomain;
use \Starkerxp\CQRSESBundle\Services\Persistence\AbstractEventStore;

class MarqueRepository extends AbstractEventStore
{

    public function get($aggregateId)
    {
        $eventStream = $this->eventStore->getHistoriqueAggregat($aggregateId);
        return MarqueDomain::reconstitutionDepuis($eventStream);
    }

}

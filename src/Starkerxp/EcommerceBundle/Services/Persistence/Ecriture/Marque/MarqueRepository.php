<?php

namespace Starkerxp\EcommerceBundle\Services\Persistence\Ecriture\Marque;

use \Starkerxp\EcommerceBundle\Services\Domain\Marque\MarqueDomain;
use \Starkerxp\CQRSESBundle\Services\Persistence\AbstractEventStore;

class MarqueRepository extends AbstractEventStore
{

    public function get($aggregateId)
    {
        $snapshot = $this->eventStore->getSnapshotAggregat($aggregateId);
        $eventStream = $this->eventStore->getHistoriqueAggregat($aggregateId, ($snapshot ? $snapshot->getVersion() : null));
        return MarqueDomain::reconstitutionDepuis($this->eventStore, $eventStream, $snapshot);
    }

}

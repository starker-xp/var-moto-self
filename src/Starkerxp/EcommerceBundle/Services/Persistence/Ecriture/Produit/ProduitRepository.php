<?php

namespace Starkerxp\EcommerceBundle\Services\Persistence\Ecriture\Produit;

use \Starkerxp\EcommerceBundle\Services\Domain\Produit\ProduitDomain;
use \Starkerxp\CQRSESBundle\Services\Persistence\AbstractEventStore;

class ProduitRepository extends AbstractEventStore
{

    public function get($aggregateId)
    {
        $snapshot = $this->eventStore->getSnapshotAggregat($aggregateId);
        $eventStream = $this->eventStore->getHistoriqueAggregat($aggregateId, ($snapshot ? $snapshot->getVersion() : null));
        return ProduitDomain::reconstitutionDepuis($this->eventStore, $eventStream, $snapshot);
    }

}

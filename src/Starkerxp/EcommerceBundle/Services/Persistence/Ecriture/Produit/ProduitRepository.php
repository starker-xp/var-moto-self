<?php

namespace Starkerxp\EcommerceBundle\Services\Persistence\Ecriture\Produit;

use \Starkerxp\EcommerceBundle\Services\Domain\Produit\ProduitDomain;
use \Starkerxp\CQRSESBundle\Services\Persistence\AbstractEventStore;

class ProduitRepository extends AbstractEventStore
{

    public function get($aggregateId)
    {
        $eventStream = $this->eventStore->getHistoriqueAggregat($aggregateId);
        return ProduitDomain::reconstitutionDepuis($eventStream);
    }

}

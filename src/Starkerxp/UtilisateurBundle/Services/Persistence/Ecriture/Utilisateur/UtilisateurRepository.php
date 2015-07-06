<?php

namespace Starkerxp\UtilisateurBundle\Services\Persistence\Ecriture\Utilisateur;

use \Starkerxp\UtilisateurBundle\Services\Domain\Utilisateur\UtilisateurDomain;
use \Starkerxp\CQRSESBundle\Services\Persistence\AbstractEventStore;

class UtilisateurRepository extends AbstractEventStore
{

    public function get($aggregateId)
    {
        $snapshot = $this->eventStore->getSnapshotAggregat($aggregateId);
        $eventStream = $this->eventStore->getHistoriqueAggregat($aggregateId, ($snapshot ? $snapshot->getVersion() : null));
        return UtilisateurDomain::reconstitutionDepuis($this->eventStore, $eventStream, $snapshot);
    }

}

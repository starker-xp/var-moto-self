<?php

namespace Starkerxp\UtilisateurBundle\Services\Persistence\Ecriture\Utilisateur;

use \Starkerxp\UtilisateurBundle\Services\Domain\Utilisateur\UtilisateurDomain;
use \Starkerxp\CQRSESBundle\Services\Persistence\AbstractEventStore;

class UtilisateurRepository extends AbstractEventStore
{

    public function get($aggregateId)
    {
        $eventStream = $this->eventStore->getHistoriqueAggregat($aggregateId);
        return UtilisateurDomain::reconstitutionDepuis($eventStream);
    }

}

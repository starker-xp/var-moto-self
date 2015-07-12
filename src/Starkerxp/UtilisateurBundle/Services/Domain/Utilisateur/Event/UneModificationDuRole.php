<?php

namespace Starkerxp\UtilisateurBundle\Services\Domain\Utilisateur\Event;

use \Starkerxp\CQRSESBundle\Services\Domain\AbstractEvent;

class UneModificationDuRole extends AbstractEvent
{

    private $utilisateurId;
    private $role;

    public function __construct($utilisateurId, $role)
    {
        $this->utilisateurId = $utilisateurId;
        $this->role = $role;
    }

    public function getAggregateId()
    {
        return $this->utilisateurId;
    }

    public function getRole()
    {
        return $this->role;
    }

}

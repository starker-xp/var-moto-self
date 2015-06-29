<?php

namespace Starkerxp\UtilisateurBundle\Services\Domain\Utilisateur\Event;

use \Starkerxp\CQRSESBundle\Services\Domain\EventInterface;

class UtilisateurAEteActive implements EventInterface
{

    private $utilisateurId;
    private $estActif;

    public function __construct($utilisateurId, $estActif)
    {
        $this->utilisateurId = $utilisateurId;
        $this->estActif = $estActif;
    }

    public function getAggregateId()
    {
        return $this->utilisateurId;
    }

    public function getEstActif()
    {
        return $this->estActif;
    }

}

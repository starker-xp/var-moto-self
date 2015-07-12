<?php

namespace Starkerxp\UtilisateurBundle\Services\Domain\Utilisateur\Event;

use \Starkerxp\CQRSESBundle\Services\Domain\AbstractEvent;

class UneModificationDuPrenom extends AbstractEvent
{

    private $utilisateurId;
    private $prenom;

    public function __construct($utilisateurId, $prenom)
    {
        $this->utilisateurId = $utilisateurId;
        $this->prenom = $prenom;
    }

    public function getAggregateId()
    {
        return $this->utilisateurId;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

}

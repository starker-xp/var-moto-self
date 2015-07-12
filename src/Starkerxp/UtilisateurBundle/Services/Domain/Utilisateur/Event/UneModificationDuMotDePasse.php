<?php

namespace Starkerxp\UtilisateurBundle\Services\Domain\Utilisateur\Event;

use \Starkerxp\CQRSESBundle\Services\Domain\AbstractEvent;

class UneModificationDuMotDePasse extends AbstractEvent
{

    private $utilisateurId;
    private $motDePasse;
    private $salt;

    public function __construct($utilisateurId, $motDePasse, $salt)
    {
        $this->utilisateurId = $utilisateurId;
        $this->motDePasse = $motDePasse;
        $this->salt = $salt;
    }

    public function getAggregateId()
    {
        return $this->utilisateurId;
    }

    public function getMotDePasse()
    {
        return $this->motDePasse;
    }

    public function getSalt()
    {
        return $this->salt;
    }

}

<?php

namespace Starkerxp\UtilisateurBundle\Services\Domain\Utilisateur\Event;

use \Starkerxp\CQRSESBundle\Services\Domain\AbstractEvent;

class UneModificationDuNom extends AbstractEvent
{

    private $utilisateurId;
    private $nom;

    public function __construct($utilisateurId, $nom)
    {
        $this->utilisateurId = $utilisateurId;
        $this->nom = $nom;
    }

    public function getAggregateId()
    {
        return $this->utilisateurId;
    }

    public function getNom()
    {
        return $this->nom;
    }

}

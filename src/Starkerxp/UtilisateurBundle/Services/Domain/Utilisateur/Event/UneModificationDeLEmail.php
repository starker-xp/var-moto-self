<?php

namespace Starkerxp\UtilisateurBundle\Services\Domain\Utilisateur\Event;

use \Starkerxp\CQRSESBundle\Services\Domain\AbstractEvent;

class UneModificationDeLEmail extends AbstractEvent
{

    private $utilisateurId;
    private $email;

    public function __construct($utilisateurId, $email)
    {
        $this->utilisateurId = $utilisateurId;
        $this->email = $email;
    }

    public function getAggregateId()
    {
        return $this->utilisateurId;
    }

    public function getEmail()
    {
        return $this->email;
    }

}

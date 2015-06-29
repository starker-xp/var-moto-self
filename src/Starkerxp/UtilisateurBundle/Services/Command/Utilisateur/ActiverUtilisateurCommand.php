<?php

namespace Starkerxp\UtilisateurBundle\Services\Command\Utilisateur;

use \Starkerxp\CQRSESBundle\Services\Command\CommandInterface;

class ActiverUtilisateurCommand implements CommandInterface
{

    private $utilisateurId;

    public function getUtilisateurId()
    {
        return $this->utilisateurId;
    }

    public function setUtilisateurId($utilisateurId)
    {
        $this->utilisateurId = $utilisateurId;
        return $this;
    }

}

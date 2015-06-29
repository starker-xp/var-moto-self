<?php

namespace Starkerxp\UtilisateurBundle\Services\Query\Utilisateur;

use Starkerxp\CQRSESBundle\Services\Query\QueryInterface;

class UtilisateurQuery implements QueryInterface
{

    private $id;

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

}

<?php

namespace Starkerxp\UtilisateurBundle\Services\Domain\Utilisateur;

use Starkerxp\CQRSESBundle\Services\Domain\AbstractCollection;

class UtilisateurCollection extends AbstractCollection
{

    public function ajouter(UtilisateurPOPO $utilisateurPOPO)
    {
        $this->collection->append($utilisateurPOPO);
    }

}

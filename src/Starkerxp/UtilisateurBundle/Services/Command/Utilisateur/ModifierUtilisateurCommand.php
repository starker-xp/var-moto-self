<?php

namespace Starkerxp\UtilisateurBundle\Services\Command\Utilisateur;

use \Starkerxp\CQRSESBundle\Services\Command\CommandInterface;

class ModifierUtilisateurCommand implements CommandInterface
{

    private $utilisateurId;
    private $nom;
    private $prenom;
    private $email;
    private $motDePasse;
    private $estActif;

    public function depuisDTO($dto)
    {

    }

}

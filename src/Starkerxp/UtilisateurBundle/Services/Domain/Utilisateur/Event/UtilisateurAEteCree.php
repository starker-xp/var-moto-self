<?php

namespace Starkerxp\UtilisateurBundle\Services\Domain\Utilisateur\Event;

use \Starkerxp\CQRSESBundle\Services\Domain\AbstractEvent;

class UtilisateurAEteCree extends AbstractEvent
{

    private $utilisateurId;
    private $role;
    private $email;
    private $nom;
    private $prenom;
    private $motDePasse;

    public function __construct($utilisateurId, $role, $email, $nom, $prenom, $motDePasse)
    {
        $this->utilisateurId = $utilisateurId;
        $this->role = $role;
        $this->email = $email;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->motDePasse = $motDePasse;
    }

    public function getAggregateId()
    {
        return $this->utilisateurId;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function getMotDePasse()
    {
        return $this->motDePasse;
    }

}

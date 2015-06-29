<?php

namespace Starkerxp\UtilisateurBundle\Services\Domain\Utilisateur;

use Starkerxp\CQRSESBundle\Services\Domain\DTOInterface;

class UtilisateurDTO implements DTOInterface
{

    private $id;
    private $email;
    private $role;
    private $nom;
    private $prenom;
    private $motDePasse;
    private $salt;
    private $estActif;

    public function __construct($id, $role, $email, $nom, $prenom, $motDePasse, $salt, $estActif)
    {
        $this->id = $id;
        $this->role = $role;
        $this->email = $email;
        $this->prenom = $prenom;
        $this->nom = $nom;
        $this->motDePasse = $motDePasse;
        $this->salt = $salt;
        $this->estActif = $estActif;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getRole()
    {
        return $this->role;
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

    public function getSalt()
    {
        return $this->salt;
    }

    public function getEstActif()
    {
        return $this->estActif;
    }

}

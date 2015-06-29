<?php

namespace Starkerxp\UtilisateurBundle\Services\Command\Utilisateur;

use \Starkerxp\CQRSESBundle\Services\Command\CommandInterface;

class CreerUtilisateurCommand implements CommandInterface
{

    private $role;
    private $email;
    private $nom;
    private $prenom;
    private $motDePasse;
    private $confirmationMotDePasse;

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

    public function getConfirmationMotDePasse()
    {
        return $this->confirmationMotDePasse;
    }

    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function setMotDePasse($motDePasse)
    {
        $this->motDePasse = $motDePasse;
        return $this;
    }

    public function setConfirmationMotDePasse($confirmationMotDePasse)
    {
        $this->confirmationMotDePasse = $confirmationMotDePasse;
        return $this;
    }

}

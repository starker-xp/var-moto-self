<?php

namespace Starkerxp\UtilisateurBundle\Services\Command\Utilisateur;

use \Starkerxp\CQRSESBundle\Services\Command\CommandInterface;

class ModifierUtilisateurCommand implements CommandInterface
{

    private $utilisateurId;
    private $role;
    private $nom;
    private $prenom;
    private $email;
    private $motDePasse;
    private $salt;
    private $estActif;

    public function __construct($utilisateurId)
    {
        $this->utilisateurId = $utilisateurId;
    }

    public function depuisDTO($dto)
    {

        $this->utilisateurId = $dto->getId();
        $this->email = $dto->getEmail();
        $this->role = $dto->getRole();
        $this->nom = $dto->getNom();
        $this->prenom = $dto->getPrenom();
        $this->motDePasse = $dto->getMotDePasse();
        $this->salt = $dto->getSalt();
        $this->estActif = $dto->getEstActif();
    }

    public function getUtilisateurId()
    {
        return $this->utilisateurId;
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

    public function getEmail()
    {
        return $this->email;
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
        return (!empty($this->estActif) ? true : false);
    }

    public function setUtilisateurId($utilisateurId)
    {
        $this->utilisateurId = $utilisateurId;
        return $this;
    }

    public function setRole($role)
    {
        $this->role = $role;
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

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function setMotDePasse($motDePasse)
    {
        $this->motDePasse = $motDePasse;
        return $this;
    }

    public function setSalt($salt)
    {
        $this->salt = $salt;
        return $this;
    }

    public function setEstActif($estActif)
    {
        $this->estActif = $estActif;
        return $this;
    }

}

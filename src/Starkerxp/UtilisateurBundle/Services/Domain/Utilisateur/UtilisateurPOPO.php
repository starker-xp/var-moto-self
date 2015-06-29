<?php

namespace Starkerxp\UtilisateurBundle\Services\Domain\Utilisateur;

use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UtilisateurPOPO extends UtilisateurDTO implements UserInterface, AdvancedUserInterface
{

    public function getRoles()
    {
        return [$this->getRole()];
    }

    /**
     * Permet de vérifier si un utilisateur possède le role désiré.
     *
     * @param type $role
     *
     * @return boolean
     */
    public function aLeRole($role)
    {
        if ($this->getRoles() == $role) {
            return true;
        }
        return false;
    }

    public function eraseCredentials()
    {

    }

    public function getPassword()
    {
        return $this->getMotDePasse();
    }

    public function getUsername()
    {
        return $this->getEmail();
    }

    /**
     * Permet de vérifier si l'utilisateur en cours est égale à celui passé en paramètre.
     *
     * @paramUtilisateurPOPOO $utilisateur
     *
     * @return boolean
     */
    public function estEgalA(UtilisateurPOPOO $utilisateur)
    {
        if ($this->getMotDePasse() !== $utilisateur->getMotDePasse()) {
            return false;
        }

        if ($this->getSalt() !== $utilisateur->getSalt()) {
            return false;
        }

        if ($this->getUsername() !== $utilisateur->getUsername()) {
            return false;
        }

        return true;
    }

    /**
     * Vérifie si le compte de l'utilisateur a expiré.
     *
     * @return boolean
     */
    public function isAccountNonExpired()
    {
        return true;
    }

    /**
     * Vérifie si le compte de l'utilisateur est bloqué.
     *
     * @return boolean
     */
    public function isAccountNonLocked()
    {
        return true;
    }

    /**
     * Permet de vérifier si les identifiants de connexion de l'utilisateur ont expiré.
     *
     * @return boolean
     */
    public function isCredentialsNonExpired()
    {
        return true;
    }

    /**
     * Permet de vérifié si un utilisateur est actif.

     * @return boolean
     */
    public function isEnabled()
    {
        if ($this->getEstActif()) {
            return true;
        }
        return false;
    }

}

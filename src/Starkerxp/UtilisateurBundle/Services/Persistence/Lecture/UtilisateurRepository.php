<?php

namespace Starkerxp\UtilisateurBundle\Services\Persistence\Lecture;

use PDO;
use Starkerxp\UtilisateurBundle\Services\Domain\Utilisateur\UtilisateurCollection;
use Starkerxp\UtilisateurBundle\Services\Domain\Utilisateur\UtilisateurPOPO;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UtilisateurRepository implements UserProviderInterface
{

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * On récupère la liste des utilisateurs.
     *
     * @return UtilisateurCollection
     */
    public function lister()
    {
        $utilisateurCollection = new UtilisateurCollection();
        $stmt = $this->pdo->query('SELECT * FROM utilisateurs');
        $stmt->execute();
        $resultSets = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resultSets as $row) {
            $utilisateurCollection->ajouter($this->_buildFromData($row));
        }
        return $utilisateurCollection;
    }

    /**
     * On récupère une utilisateur en particulier.
     *
     * @param type $utilisateurId L'id du utilisateur.
     *
     * @return UtilisateurPOPO
     */
    public function get($utilisateurId)
    {
        $sql = "SELECT * FROM utilisateurs WHERE id = :utilisateur_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue("utilisateur_id", $utilisateurId);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $utilisateurPOPO = $this->_buildFromData($row);
        return $utilisateurPOPO;
    }

    /**
     * On génère un nouvel objet utilisateurPOPO à partir des données issus de la base de données.
     *
     * @param array $row
     *
     * @return UtilisateurPOPO
     */
    private function _buildFromData($row)
    {
        $utilisateurPOPO = new UtilisateurPOPO($row['id'], $row['role'], $row['email'], $row['nom'], $row['prenom'], $row['mot_de_passe'], $row['salt'], $row['est_actif']);
        return $utilisateurPOPO;
    }

    /**
     * Retourne un utilisateur en fonction de son username;
     *
     * @param string $username
     * 
     * @return UtilisateurPOPO
     */
    public function loadUserByUsername($username)
    {
        $sql = "SELECT * FROM utilisateurs WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue("email", $username);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $utilisateurPOPO = $this->_buildFromData($row);
        return $utilisateurPOPO;
    }

    /**
     * Permet d'actualiser les données de l'utilisateur en cours.
     *
     * @param \Symfony\Component\Security\Core\User\UserInterface $user
     */
    public function refreshUser(\Symfony\Component\Security\Core\User\UserInterface $user)
    {
        $class = get_class($user);
        if (!$this->supportsClass($class)) {
            throw new Exception(sprintf('Instances of "%s" are not supported.', $class));
        }
        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return true;
        // return $this->getNom() === $class || is_subclass_of($class, $this->getNom());
    }

}

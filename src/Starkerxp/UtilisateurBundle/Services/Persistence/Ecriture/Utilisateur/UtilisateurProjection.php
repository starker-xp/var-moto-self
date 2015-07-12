<?php

namespace Starkerxp\UtilisateurBundle\Services\Persistence\Ecriture\Utilisateur;

use Starkerxp\CQRSESBundle\Services\Persistence\AbstractProjection;
use Starkerxp\UtilisateurBundle\Services\Domain\Utilisateur\Event\UneModificationDeLEmail;
use Starkerxp\UtilisateurBundle\Services\Domain\Utilisateur\Event\UneModificationDuMotDePasse;
use Starkerxp\UtilisateurBundle\Services\Domain\Utilisateur\Event\UneModificationDuNom;
use Starkerxp\UtilisateurBundle\Services\Domain\Utilisateur\Event\UneModificationDuPrenom;
use Starkerxp\UtilisateurBundle\Services\Domain\Utilisateur\Event\UneModificationDuRole;
use Starkerxp\UtilisateurBundle\Services\Domain\Utilisateur\Event\UneUtilisateurAEteSupprime;
use Starkerxp\UtilisateurBundle\Services\Domain\Utilisateur\Event\UtilisateurAEteActive;
use Starkerxp\UtilisateurBundle\Services\Domain\Utilisateur\Event\UtilisateurAEteCree;
use Starkerxp\UtilisateurBundle\Services\Domain\Utilisateur\Event\UtilisateurAEteDesactive;

class UtilisateurProjection extends AbstractProjection
{

    public function projectUtilisateurAEteCree(UtilisateurAEteCree $event)
    {
        $sql = 'INSERT INTO utilisateurs (id, role, email, nom, prenom, mot_de_passe) VALUES (:utilisateur_id, :role, :email, :nom, :prenom, :mot_de_passe)';
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->execute([
            ':utilisateur_id' => $event->getAggregateId(),
            ':role' => $event->getRole(),
            ':email' => $event->getEmail(),
            ':nom' => $event->getNom(),
            ':prenom' => $event->getPrenom(),
            ':mot_de_passe' => $event->getMotDePasse(),
        ]);
    }

    public function projectUtilisateurAEteActive(UtilisateurAEteActive $event)
    {
        $sql = 'UPDATE utilisateurs SET est_actif= :est_actif WHERE id= :utilisateur_id';
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->execute([
            ':utilisateur_id' => $event->getAggregateId(),
            ':est_actif' => $event->getEstActif(),
        ]);
    }

    public function projectUneUtilisateurAEteSupprime(UneUtilisateurAEteSupprime $event)
    {
        $sql = 'DELETE FROM utilisateurs WHERE id= :utilisateur_id';
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->execute([
            ':utilisateur_id' => $event->getAggregateId()
        ]);
    }

    public function projectUneModificationDuNom(UneModificationDuNom $event)
    {
        $sql = 'UPDATE utilisateurs SET nom= :nom WHERE id= :utilisateur_id';
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->execute([
            ':utilisateur_id' => $event->getAggregateId(),
            ':nom' => $event->getNom(),
        ]);
    }

    public function projectUneModificationDuPrenom(UneModificationDuPrenom $event)
    {
        $sql = 'UPDATE utilisateurs SET prenom= :prenom WHERE id= :utilisateur_id';
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->execute([
            ':utilisateur_id' => $event->getAggregateId(),
            ':prenom' => $event->getPrenom(),
        ]);
    }

    public function projectUneModificationDuMotDePasse(UneModificationDuMotDePasse $event)
    {
        $sql = 'UPDATE utilisateurs SET mot_de_passe= :mot_de_passe WHERE id= :utilisateur_id';
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->execute([
            ':utilisateur_id' => $event->getAggregateId(),
            ':mot_de_passe' => $event->getMotDePasse(),
        ]);
    }

    public function projectUneModificationDuRole(UneModificationDuRole $event)
    {
        $sql = 'UPDATE utilisateurs SET role= :roleWHERE id= :utilisateur_id';
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->execute([
            ':utilisateur_id' => $event->getAggregateId(),
            ':role' => $event->getRole(),
        ]);
    }

    public function projectUtilisateurAEteDesactive(UtilisateurAEteDesactive $event)
    {
        $sql = 'UPDATE utilisateurs SET est_actif= :est_actif WHERE id= :utilisateur_id';
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->execute([
            ':utilisateur_id' => $event->getAggregateId(),
            ':est_actif' => $event->getEstActif(),
        ]);
    }

    public function projectUneModificationDeLEmail(UneModificationDeLEmail $event)
    {
        $sql = 'UPDATE utilisateurs SET email= :email WHERE id= :utilisateur_id';
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->execute([
            ':utilisateur_id' => $event->getAggregateId(),
            ':email' => $event->getEmail(),
        ]);
    }

}

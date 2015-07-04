<?php

namespace Starkerxp\UtilisateurBundle\Services\Persistence\Ecriture\Utilisateur;

use Starkerxp\CQRSESBundle\Services\Persistence\AbstractProjection;
use Starkerxp\UtilisateurBundle\Services\Domain\Utilisateur\Event\UneUtilisateurAEteSupprime;
use Starkerxp\UtilisateurBundle\Services\Domain\Utilisateur\Event\UtilisateurAEteActive;
use Starkerxp\UtilisateurBundle\Services\Domain\Utilisateur\Event\UtilisateurAEteCree;

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

//    public function projectModificationLibelleUtilisateur(ModificationLibelleUtilisateur $event)
//    {
//        $sql = 'UPDATE utilisateurs SET libelle= :libelle WHERE id= :utilisateur_id';
//        $stmt = $this->getPdo()->prepare($sql);
//        $stmt->execute([
//            ':utilisateur_id' => $event->getAggregateId(),
//            ':libelle' => $event->getLibelle(),
//        ]);
//    }

    public function projectUneUtilisateurAEteSupprime(UneUtilisateurAEteSupprime $event)
    {
        $sql = 'DELETE FROM utilisateurs WHERE id= :utilisateur_id';
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->execute([
            ':utilisateur_id' => $event->getAggregateId()
        ]);
    }

}

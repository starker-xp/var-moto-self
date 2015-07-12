<?php

namespace Starkerxp\UtilisateurBundle\Services\Domain\Utilisateur;

use Starkerxp\CQRSESBundle\Services\Domain\DomainEvents;
use Starkerxp\UtilisateurBundle\Services\Domain\Utilisateur\Event\UneModificationDeLEmail;
use Starkerxp\UtilisateurBundle\Services\Domain\Utilisateur\Event\UneModificationDuMotDePasse;
use Starkerxp\UtilisateurBundle\Services\Domain\Utilisateur\Event\UneModificationDuNom;
use Starkerxp\UtilisateurBundle\Services\Domain\Utilisateur\Event\UneModificationDuPrenom;
use Starkerxp\UtilisateurBundle\Services\Domain\Utilisateur\Event\UneModificationDuRole;
use Starkerxp\UtilisateurBundle\Services\Domain\Utilisateur\Event\UneUtilisateurAEteSupprime;
use Starkerxp\UtilisateurBundle\Services\Domain\Utilisateur\Event\UtilisateurAEteActive;
use Starkerxp\UtilisateurBundle\Services\Domain\Utilisateur\Event\UtilisateurAEteCree;
use Starkerxp\UtilisateurBundle\Services\Domain\Utilisateur\Event\UtilisateurAEteDesactive;

class UtilisateurDomain extends DomainEvents
{

    private $utilisateurId;
    private $role;
    private $email;
    private $nom;
    private $prenom;
    private $motDePasse;
    private $estActif;

    private function __construct($utilisateurId, $role, $email, $nom, $prenom, $motDePasse)
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

    public static function cree($utilisateurId, $role, $email, $nom, $prenom, $motDePasse)
    {
        $nouvelleUtilisateur = new UtilisateurDomain($utilisateurId, $role, $email, $nom, $prenom, $motDePasse);
        $nouvelleUtilisateur->enregistrementEvenement(new UtilisateurAEteCree($utilisateurId, $role, $email, $nom, $prenom, $motDePasse));
        return $nouvelleUtilisateur;
    }

    public static function creeVide($utilisateurId)
    {
        return new UtilisateurDomain($utilisateurId, null, null, null, null, null);
    }

    public function applyUtilisateurAEteCree($event)
    {
        $this->role = $event->getRole();
        $this->email = $event->getEmail();
        $this->nom = $event->getNom();
        $this->prenom = $event->getPrenom();
        $this->motDePasse = $event->getMotDePasse();
    }

    public function applyUneUtilisateurAEteSupprime($event)
    {

    }

    public function activerCompteUtilisateur()
    {
        $event = new UtilisateurAEteActive($this->utilisateurId, 1);
        $event->setVersion($this->getUpdateVersion());
        $this->enregistrementEvenement($event);
        $this->apply($event);
    }

    public function applyUtilisateurAEteActive($event)
    {
        $this->estActif = $event->getEstActif();
    }

    public function applyUtilisateurAEteDesactive($event)
    {
        $this->estActif = false;
    }

    public function modifierLUtilisateur($command)
    {
        if ($this->role != ($role = $command->getRole())) {
            $this->modifierLeRole($role);
        }
        if ($this->email != ($email = $command->getEmail())) {
            $this->modifierLeChampEmail($email);
        }
        if ($this->nom != ($nom = $command->getNom())) {
            $this->modifierLeNom($nom);
        }
        if ($this->prenom != ($prenom = $command->getPrenom())) {
            $this->modifierLePrenom($prenom);
        }
        if ($this->motDePasse != ($motDePasse = $command->getMotDePasse()) && !empty($motDePasse)) {
            $this->modifierLeMotDePasse($motDePasse, $command->getSalt());
        }
        if ($this->estActif != ($estActif = $command->getEstActif())) {
            $this->modifierLeChampEstActif($estActif);
        }
    }

    public function modifierLeRole($role)
    {
        $event = new UneModificationDuRole($this->utilisateurId, $role);
        $event->setVersion($this->getUpdateVersion());
        $this->enregistrementEvenement($event);
        $this->apply($event);
    }

    public function applyUneModificationDuRole($event)
    {
        $this->role = $event->getRole();
    }

    public function modifierLeMotDePasse($motDePasse, $salt)
    {
        $event = new UneModificationDuMotDePasse($this->utilisateurId, $motDePasse, $salt);
        $event->setVersion($this->getUpdateVersion());
        $this->enregistrementEvenement($event);
        $this->apply($event);
    }

    public function applyUneModificationDuMotDePasse($event)
    {
        $this->motDePasse = $event->getMotDePasse();
    }

    public function modifierLeChampEstActif($estActif)
    {
        $event = new UtilisateurAEteActive($this->utilisateurId, $estActif);
        if (!empty($estActif)) {
            $event = new UtilisateurAEteDesactive($this->utilisateurId, $estActif);
        }
        $event->setVersion($this->getUpdateVersion());
        $this->enregistrementEvenement($event);
        $this->apply($event);
    }

    public function modifierLeNom($nom)
    {
        $event = new UneModificationDuNom($this->utilisateurId, $nom);
        $event->setVersion($this->getUpdateVersion());
        $this->enregistrementEvenement($event);
        $this->apply($event);
    }

    public function applyUneModificationDuNom($event)
    {
        $this->nom = $event->getNom();
    }

    public function modifierLePrenom($prenom)
    {
        $event = new UneModificationDuPrenom($this->utilisateurId, $prenom);
        $event->setVersion($this->getUpdateVersion());
        $this->enregistrementEvenement($event);
        $this->apply($event);
    }

    public function applyUneModificationDuPrenom($event)
    {
        $this->prenom = $event->getPrenom();
    }

    public function modifierLeChampEmail($email)
    {
        $event = new UneModificationDeLEmail($this->utilisateurId, $email);
        $event->setVersion($this->getUpdateVersion());
        $this->enregistrementEvenement($event);
        $this->apply($event);
    }

    public function applyUneModificationDeLEmail($event)
    {
        $this->email = $event->getEmail();
    }

    public function supprimerUneUtilisateur()
    {
        $event = new UneUtilisateurAEteSupprime($this->utilisateurId);
        $event->setVersion($this->getUpdateVersion());
        $this->enregistrementEvenement($event);
    }

}

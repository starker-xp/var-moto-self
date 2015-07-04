<?php

namespace Starkerxp\UtilisateurBundle\Services\Domain\Utilisateur;

use Starkerxp\CQRSESBundle\Services\Domain\DomainEvents;
use Starkerxp\UtilisateurBundle\Services\Domain\Utilisateur\Event\UneUtilisateurAEteSupprime;
use Starkerxp\UtilisateurBundle\Services\Domain\Utilisateur\Event\UtilisateurAEteActive;
use Starkerxp\UtilisateurBundle\Services\Domain\Utilisateur\Event\UtilisateurAEteCree;

class UtilisateurDomain extends DomainEvents
{

    private $utilisateurId;
    private $role;
    private $email;
    private $nom;
    private $prenom;
    private $motDePasse;
    private $estActif;

    private function __construct($utilisateurId, $libelle)
    {
        $this->utilisateurId = $utilisateurId;
        $this->libelle = $libelle;
    }

    public static function cree($utilisateurId, $role, $email, $nom, $prenom, $motDePasse)
    {
        $nouvelleUtilisateur = new UtilisateurDomain($utilisateurId, $role, $email, $nom, $prenom, $motDePasse);
        $nouvelleUtilisateur->enregistrementEvenement(new UtilisateurAEteCree($utilisateurId, $role, $email, $nom, $prenom, $motDePasse));
        return $nouvelleUtilisateur;
    }

    /**
     * Permet de reconstruire un objet depuis sa collection d'évènements.
     *
     * @param type $aggregateHistorique
     *
     * @return type
     */
    public static function reconstitutionDepuis($aggregateHistorique)
    {
        $utilisateur = static::creeVide($aggregateHistorique->getAggregateId());
        $events = $aggregateHistorique->getEvents();
        foreach ($events as $event) {
            $utilisateur->apply($event);
        }
        return $utilisateur;
    }

    private static function creeVide($utilisateurId)
    {
        return new UtilisateurDomain($utilisateurId, '');
    }

    /**
     * Permet d'appliquer un event à l'objet en cours.
     *
     * @param type $anEvent
     */
    private function apply($anEvent)
    {
        $explodeEvent = explode("\\", get_class($anEvent));
        $method = 'apply' . $explodeEvent[count($explodeEvent) - 1];
        $this->$method($anEvent);
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
        $this->enregistrementEvenement($event);
        $this->apply($event);
    }

    public function applyUtilisateurAEteActive($event)
    {
        $this->estActif = $event->getEstActif();
    }

    public function modifierLUtilisateur($command)
    {
        if ($this->nom != ($nom = $command->getNom())) {
            $this->modifierLeNom($nom);
        }
        if ($this->prenom != ($prenom = $command->getPrenom())) {
            $this->modifierLePrenom($prenom);
        }
        if ($this->email != ($email = $command->getEmail())) {
            $this->modifierLEmail($email);
        }
    }

    public function modifierLeNom($nom)
    {
        $event = new UneModificationDuNom($this->utilisateurId, $nom);
        $this->enregistrementEvenement($event);
        $this->apply($event);
    }

    public function modifierLePrenom($prenom)
    {
        $event = new UneModificationDuPrenom($this->utilisateurId, $prenom);
        $this->enregistrementEvenement($event);
        $this->apply($event);
    }

    public function modifierLEmail($email)
    {
        $event = new UneModificationDeLEmail($this->utilisateurId, $email);
        $this->enregistrementEvenement($event);
        $this->apply($event);
    }

    public function supprimerUneUtilisateur()
    {
        $event = new UneUtilisateurAEteSupprime($this->utilisateurId);
        $this->enregistrementEvenement($event);
    }

}
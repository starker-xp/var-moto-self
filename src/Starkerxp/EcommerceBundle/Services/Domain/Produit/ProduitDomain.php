<?php

namespace Starkerxp\EcommerceBundle\Services\Domain\Produit;

use Starkerxp\CQRSESBundle\Services\Domain\DomainEvents;
use Starkerxp\EcommerceBundle\Services\Domain\Produit\Event\LeProduitAEteModifie;
use Starkerxp\EcommerceBundle\Services\Domain\Produit\Event\ProduitAEteCree;

class ProduitDomain extends DomainEvents
{

    private $produitId;
    private $libelle;
    private $description;
    private $prix;
    private $quantite;
    private $marqueId;

    private function __construct($produitId, $marqueId, $libelle, $description, $prix, $quantite)
    {
        $this->produitId = $produitId;
        $this->marqueId = $marqueId;
        $this->libelle = $libelle;
        $this->description = $description;
        $this->prix = $prix;
        $this->quantite = $quantite;
    }

    public static function cree($produitId, $marqueId, $libelle, $description, $prix, $quantite)
    {
        $nouveauProduit = new ProduitDomain($produitId, $marqueId, $libelle, $description, $prix, $quantite);
        $nouveauProduit->enregistrementEvenement(new ProduitAEteCree($produitId, $marqueId, $libelle, $description, $prix, $quantite));
        return $nouveauProduit;
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
        $produit = static::creeVide($aggregateHistorique->getAggregateId());
        $events = $aggregateHistorique->getEvents();
        foreach ($events as $event) {
            $produit->apply($event);
        }
        return $produit;
    }

    private static function creeVide($produitId)
    {
        return new ProduitDomain($produitId, '', '', '', '', '');
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

    public function applyProduitAEteCree($event)
    {
        $this->marqueId = $event->getMarqueId();
        $this->libelle = $event->getLibelle();
        $this->description = $event->getDescription();
        $this->prix = $event->getPrix();
        $this->quantite = $event->getQuantite();
    }

    public function modifierLeLibelle($libelle)
    {
        $event = new UneModificationDuLibelleProduit($this->produitId, $libelle);
        $this->enregistrementEvenement($event);
        $this->apply($event);
    }

    public function applyUneModificationDuLibelleProduit($event)
    {
        $this->libelle = $event->getLibelle();
    }

    public function modifierLaDescription($description)
    {
        $event = new UneModificationDeLaDescriptionProduit($this->produitId, $description);
        $this->enregistrementEvenement($event);
        $this->apply($event);
    }

    public function applyUneModificationDeLaDescriptionProduit($event)
    {
        $this->description = $event->getDescription();
    }

    public function modifierLePrix($prix)
    {
        $event = new UneModificationDuPrixProduit($this->produitId, $prix);
        $this->enregistrementEvenement($event);
        $this->apply($event);
    }

    public function applyUneModificationDuPrixProduit($event)
    {
        $this->prix = $event->getPrix();
    }

    public function modifierLaQuantite($quantite)
    {
        $event = new UneModificationDeLaQuantiteProduit($this->produitId, $quantite);
        $this->enregistrementEvenement($event);
        $this->apply($event);
    }

    public function applyUneModificationDeLaQuantiteProduit($event)
    {
        $this->quantite = $event->getQuantite();
    }

    public function modifierLaMarque($marqueId)
    {
        $event = new UneModificationDeLaMarqueProduit($this->produitId, $marqueId);
        $this->enregistrementEvenement($event);
        $this->apply($event);
    }

    public function applyUneModificationDeLaMarqueProduit($event)
    {
        $this->marqueId = $event->getMarqueId();
    }

    public function modifierLeProduit($command)
    {
        if ($this->libelle != ($libelle = $command->getLibelle())) {
            $this->modifierLeLibelle($libelle);
        }

        if ($this->description != ($description = $command->getDescription())) {
            $this->modifierLaDescription($description);
        }

        if ($this->prix != ($prix = $command->getPrix())) {
            $this->modifierLePrix($prix);
        }

        if ($this->quantite != ($quantite = $command->getQuantite())) {
            $this->modifierLaQuantite($quantite);
        }

        if ($this->marqueId != ($marqueId = $command->getMarqueId())) {
            $this->modifierLaMarque($marqueId);
        }
    }

}

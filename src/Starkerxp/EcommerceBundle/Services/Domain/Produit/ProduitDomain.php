<?php

namespace Starkerxp\EcommerceBundle\Services\Domain\Produit;

use Starkerxp\CQRSESBundle\Services\Domain\DomainEvents;
use Starkerxp\EcommerceBundle\Services\Domain\Produit\Event\ProduitAEteCree;

class ProduitDomain extends DomainEvents
{

    private $produitId;
    private $libelle;
    private $description;
    private $prix;
    private $quantite;
    //
    private $marque;

    private function __construct($produitId, $marque, $libelle, $description, $prix, $quantite)
    {
        $this->produitId = $produitId;
        $this->marque = $marque;
        $this->libelle = $libelle;
        $this->description = $description;
        $this->prix = $prix;
        $this->quantite = $quantite;
    }

    public static function cree($produitId, $marque, $libelle, $description, $prix, $quantite)
    {
        $nouveauProduit = new ProduitDomain($produitId, $marque, $libelle, $description, $prix, $quantite);
        $nouveauProduit->enregistrementEvenement(new ProduitAEteCree($produitId, $marque, $libelle, $description, $prix, $quantite));
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
        $this->marque = $event->getMarque();
        $this->libelle = $event->getLibelle();
        $this->description = $event->getDescription();
        $this->prix = $event->getPrix();
        $this->quantite = $event->getQuantite();
    }

}

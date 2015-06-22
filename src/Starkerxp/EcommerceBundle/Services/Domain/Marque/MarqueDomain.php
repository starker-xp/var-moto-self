<?php

namespace Starkerxp\EcommerceBundle\Services\Domain\Marque;

use Starkerxp\EcommerceBundle\Services\Domain\Marque\Event\MarqueAEteCree;
use Starkerxp\EcommerceBundle\Services\Domain\Marque\Event\ModificationLibelleMarque;
use Starkerxp\EcommerceBundle\Services\Domain\Marque\Event\UneMarqueAEteSupprime;
use Starkerxp\CQRSESBundle\Services\Domain\DomainEvents;

class MarqueDomain extends DomainEvents
{

    private $marqueId;
    private $libelle;

    private function __construct($marqueId, $libelle)
    {
        $this->marqueId = $marqueId;
        $this->libelle = $libelle;
    }

    public static function cree($marqueId, $libelle)
    {
        $nouvelleMarque = new MarqueDomain($marqueId, $libelle);
        $nouvelleMarque->enregistrementEvenement(new MarqueAEteCree($marqueId, $libelle));
        return $nouvelleMarque;
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
        $marque = static::creeVide($aggregateHistorique->getAggregateId());
        $events = $aggregateHistorique->getEvents();
        foreach ($events as $event) {
            $marque->apply($event);
        }
        return $marque;
    }

    private static function creeVide($marqueId)
    {
        return new MarqueDomain($marqueId, '');
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

    public function applyMarqueAEteCree($event)
    {
        $this->libelle = $event->getLibelle();
    }

    public function applyModificationLibelleMarque($event)
    {
        $this->libelle = $event->getLibelle();
    }

    public function applyUneMarqueAEteSupprime($event)
    {

    }

    public function modifierLibelle($nouveauLibelle)
    {
        $event = new ModificationLibelleMarque($this->marqueId, $nouveauLibelle);
        $this->enregistrementEvenement($event);
        $this->apply($event);
    }

    public function supprimerUneMarque()
    {
        $event = new UneMarqueAEteSupprime($this->marqueId);
        $this->enregistrementEvenement($event);
    }

}

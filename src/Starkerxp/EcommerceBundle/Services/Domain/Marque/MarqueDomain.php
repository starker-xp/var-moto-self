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

    public function getAggregateId()
    {
        return $this->marqueId;
    }

    public static function cree($marqueId, $libelle)
    {
        $nouvelleMarque = new MarqueDomain($marqueId, $libelle);
        $nouvelleMarque->enregistrementEvenement(new MarqueAEteCree($marqueId, $libelle));
        return $nouvelleMarque;
    }

    public static function creeVide($marqueId)
    {
        return new MarqueDomain($marqueId, null);
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

    public function modifierLeLibelle($nouveauLibelle)
    {
        $event = new ModificationLibelleMarque($this->marqueId, $nouveauLibelle);
        $event->setVersion($this->getUpdateVersion());
        $this->enregistrementEvenement($event);
        $this->apply($event);
    }

    public function supprimerUneMarque()
    {
        $event = new UneMarqueAEteSupprime($this->marqueId);
        $event->setVersion($this->getUpdateVersion());
        $this->enregistrementEvenement($event);
    }

    public function modifierLaMarque($command)
    {
        if ($this->libelle != ($libelle = $command->getLibelle())) {
            $this->modifierLeLibelle($libelle);
        }
    }

}

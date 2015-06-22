<?php

namespace Starkerxp\CQRSESBundle\Services\Persistence;

abstract class AbstractEventStore
{

    protected $eventStore;
    protected $projection;

    abstract public function get($aggregateId);

    public function __construct($eventStore, $projection)
    {
        $this->eventStore = $eventStore;
        $this->projection = $projection;
    }

    /**
     * Permet de jouer un évènement dans l'Event Store
     *
     * @param type $aggregate
     *
     * @return void
     */
    public function ajouter($aggregate)
    {
        $events = $aggregate->getEvenementsEnregistres();
        // On enregistre l'event dans l'event_store.
        $this->eventStore->commit($events);
        // On génère la projection dans la base de données.
        $this->projection->project($events);
        $aggregate->suppressionEvenementsEnregistres();
    }

}

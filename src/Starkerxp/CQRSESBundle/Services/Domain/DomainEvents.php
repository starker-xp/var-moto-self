<?php

namespace Starkerxp\CQRSESBundle\Services\Domain;

class DomainEvents
{

    private $recordedEvents = [];

    /**
     * On retourne la liste des évènements enregistrés.
     */
    public function getEvenementsEnregistres()
    {
        return $this->recordedEvents;
    }

    /**
     * On supprime la liste des evenements enregistrés.
     *
     * @return void
     */
    public function suppressionEvenementsEnregistres()
    {
        $this->recordedEvents = [];
    }

    /**
     * On enregistre un nouvel évènement.
     *
     * @param \Starkerxp\CQRSESBundle\Domain\EventInterface $domainEvents
     */
    public function enregistrementEvenement(EventInterface $domainEvents)
    {
        $this->recordedEvents[] = $domainEvents;
    }

}

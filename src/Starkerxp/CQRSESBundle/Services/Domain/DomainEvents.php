<?php

namespace Starkerxp\CQRSESBundle\Services\Domain;

abstract class DomainEvents
{

    protected $version = 1;
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

    public function getVersion()
    {
        return $this->version;
    }

    public function setVersion($version)
    {
        $this->version = $version;
        return $this;
    }

    public function getUpdateVersion()
    {
        $this->version++;
        return $this->version;
    }

}

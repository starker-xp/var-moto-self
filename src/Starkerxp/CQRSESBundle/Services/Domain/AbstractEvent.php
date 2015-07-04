<?php

namespace Starkerxp\CQRSESBundle\Services\Domain;

abstract class AbstractEvent implements EventInterface
{

    private $adapterNouvelEvent;

    public function misAJourEvent()
    {
        $adapter = $this->getAdapterNouvelEvent();
        if (!empty($adapter)) {
            return $adapter->run($this);
        }
        return false;
    }

    public function getAdapterNouvelEvent()
    {
        return $this->adapterNouvelEvent;
    }

    public function setAdapterNouvelEvent($adapterNouvelEvent)
    {
        $this->adapterNouvelEvent = $adapterNouvelEvent;
        return $this;
    }

}

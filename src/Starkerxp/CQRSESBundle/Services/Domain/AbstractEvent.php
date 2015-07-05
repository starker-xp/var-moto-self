<?php

namespace Starkerxp\CQRSESBundle\Services\Domain;

abstract class AbstractEvent implements EventInterface
{

    public function getEvent()
    {
        return $this;
    }

}

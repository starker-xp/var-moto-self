<?php

namespace Starkerxp\CQRSESBundle\Services\Domain;

interface EventInterface
{

    public function getAggregateId();
}

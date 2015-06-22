<?php

namespace Starkerxp\EcommerceBundle\Services\Domain\Marque;

use ArrayObject;

class MarqueCollection
{

    private $marqueCollection;

    public function __construct()
    {
        $this->marqueCollection = new ArrayObject([]);
    }

    public function ajouter(MarqueDTO $marqueDto)
    {
        $this->marqueCollection->append($marqueDto);
    }

    public function getCollection()
    {
        return $this->marqueCollection;
    }

}

<?php

namespace Starkerxp\EcommerceBundle\Services\Domain\Marque;

use Starkerxp\CQRSESBundle\Services\Domain\AbstractCollection;

class MarqueCollection extends AbstractCollection
{

    public function ajouter(MarqueDTO $marqueDto)
    {
        $this->collection->append($marqueDto);
    }

}

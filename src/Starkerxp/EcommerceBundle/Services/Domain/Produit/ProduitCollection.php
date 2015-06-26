<?php

namespace Starkerxp\EcommerceBundle\Services\Domain\Produit;

use Starkerxp\CQRSESBundle\Services\Domain\AbstractCollection;

class ProduitCollection extends AbstractCollection
{

    public function ajouter(ProduitDTO $marqueDto)
    {
        $this->collection->append($marqueDto);
    }

}

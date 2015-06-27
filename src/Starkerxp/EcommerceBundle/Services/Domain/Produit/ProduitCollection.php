<?php

namespace Starkerxp\EcommerceBundle\Services\Domain\Produit;

use Starkerxp\CQRSESBundle\Services\Domain\AbstractCollection;

class ProduitCollection extends AbstractCollection
{

    public function ajouter(ProduitPOPO $marquePOPO)
    {
        $this->collection->append($marquePOPO);
    }

}

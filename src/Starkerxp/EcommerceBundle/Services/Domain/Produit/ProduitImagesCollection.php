<?php

namespace Starkerxp\EcommerceBundle\Services\Domain\Produit;

use Starkerxp\CQRSESBundle\Services\Domain\AbstractCollection;

class ProduitImagesCollection extends AbstractCollection
{

    public function ajouter(ProduitImagePOPO $marquePOPO)
    {
        $this->collection->append($marquePOPO);
    }

}

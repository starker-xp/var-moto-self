<?php

namespace Starkerxp\EcommerceBundle\Services\Domain\Produit;

use ArrayObject;

class ProduitCollection
{

    private $produitCollection;

    public function __construct()
    {
        $this->produitCollection = new ArrayObject([]);
    }

    public function ajouter(ProduitDTO $produitDto)
    {
        $this->produitCollection->append($produitDto);
    }

    public function getCollection()
    {
        return $this->produitCollection;
    }

}

<?php

namespace Starkerxp\EcommerceBundle\Services\Query\Produit;

use Starkerxp\CQRSESBundle\Services\Query\QueryInterface;

class ImageProduitParDefautQuery implements QueryInterface
{

    private $produitId;

    public function getProduitId()
    {
        return $this->produitId;
    }

    public function setProduitId($produitId)
    {
        $this->produitId = $produitId;
        return $this;
    }

}

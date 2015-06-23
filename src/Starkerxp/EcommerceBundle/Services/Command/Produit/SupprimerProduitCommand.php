<?php

namespace Starkerxp\EcommerceBundle\Services\Command\Produit;

use Starkerxp\CQRSESBundle\Services\Command\CommandInterface;

class SupprimerProduitCommand implements CommandInterface
{

    private $produitId;

    /**
     * @return string
     */
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

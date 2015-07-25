<?php

namespace Starkerxp\EcommerceBundle\Services\Command\Produit;

use Starkerxp\CQRSESBundle\Services\Command\CommandInterface;

class SupprimerImageProduitCommand implements CommandInterface
{

    private $produitId;
    private $imageProduitId;

    /**
     * @return string
     */
    public function getImageProduitId()
    {
        return $this->imageProduitId;
    }

    public function setImageProduitId($imageProduitId)
    {
        $this->imageProduitId = $imageProduitId;
        return $this;
    }

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

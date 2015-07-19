<?php

namespace Starkerxp\EcommerceBundle\Services\Domain\Produit;

use Starkerxp\CQRSESBundle\Services\Domain\DTOInterface;

class ProduitImageDTO implements DTOInterface
{

    private $id;
    private $produitId;
    private $url;
    private $affichageParDefaut;

    public function __construct($id, $produitId, $url, $affichageParDefaut = 0)
    {
        $this->id = $id;
        $this->produitId = $produitId;
        $this->url = $url;
        $this->affichageParDefaut = $affichageParDefaut;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getProduitId()
    {
        return $this->produitId;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getAffichageParDefaut()
    {
        return $this->affichageParDefaut;
    }

}

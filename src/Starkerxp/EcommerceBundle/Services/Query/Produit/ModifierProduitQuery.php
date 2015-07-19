<?php

namespace Starkerxp\EcommerceBundle\Services\Query\Produit;

use Starkerxp\CQRSESBundle\Services\Query\QueryInterface;

class ModifierProduitQuery implements QueryInterface
{

    private $id;

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

}

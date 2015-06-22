<?php

namespace Starkerxp\EcommerceBundle\Services\Query\Marque;

use Starkerxp\CQRSESBundle\Services\Query\QueryInterface;

class MarqueQuery implements QueryInterface
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

<?php

namespace Starkerxp\EcommerceBundle\Services\Domain\Marque;

use Starkerxp\CQRSESBundle\Services\Domain\DTOInterface;

class MarqueDTO implements DTOInterface
{

    private $id;
    private $libelle;

    public function __construct($id, $libelle)
    {
        $this->id = $id;
        $this->libelle = $libelle;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getLibelle()
    {
        return $this->libelle;
    }

}

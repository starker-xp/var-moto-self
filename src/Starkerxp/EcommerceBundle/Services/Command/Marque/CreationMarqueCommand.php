<?php

namespace Starkerxp\EcommerceBundle\Services\Command\Marque;

use \Starkerxp\CQRSESBundle\Services\Command\CommandInterface;

class CreationMarqueCommand implements CommandInterface
{

    private $libelle;

    /**
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
        return $this;
    }

}

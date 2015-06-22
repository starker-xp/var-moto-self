<?php

namespace Starkerxp\EcommerceBundle\Services\Command\Marque;

use \Starkerxp\CQRSESBundle\Services\Command\CommandInterface;

class ModificationMarqueCommand implements CommandInterface
{

    private $marqueId;
    private $libelle;

    /**
     * @return string
     */
    public function getMarqueId()
    {
        return $this->marqueId;
    }

    /**
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    public function setMarqueId($marqueId)
    {
        $this->marqueId = $marqueId;
        return $this;
    }

    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
        return $this;
    }

}

<?php

namespace Starkerxp\EcommerceBundle\Services\Command\Marque;

use Starkerxp\CQRSESBundle\Services\Command\CommandInterface;

class SupprimerMarqueCommand implements CommandInterface
{

    private $marqueId;

    /**
     * @return string
     */
    public function getMarqueId()
    {
        return $this->marqueId;
    }

    public function setMarqueId($marqueId)
    {
        $this->marqueId = $marqueId;
        return $this;
    }

}

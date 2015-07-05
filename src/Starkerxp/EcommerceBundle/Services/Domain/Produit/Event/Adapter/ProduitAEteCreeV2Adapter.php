<?php

namespace Starkerxp\EcommerceBundle\Services\Domain\Produit\Event\Adapter;

use Starkerxp\CQRSESBundle\Services\Domain\AbstractEvent;
use Starkerxp\CQRSESBundle\Services\Domain\EventAdapterInterface;
use Starkerxp\EcommerceBundle\Services\Domain\Produit\Event\ProduitAEteCreeV2;

class ProduitAEteCreeV2Adapter implements EventAdapterInterface
{

    /**
     *
     * @param AbstractEvent $event
     * @return ProduitAEteCreeV2
     */
    public function run(AbstractEvent $event)
    {
        $images = null;
        $nouvelEvent = new ProduitAEteCreeV2($event->getAggregateId(), $event->getMarqueId(), $event->getLibelle(), $event->getDescription(), $event->getPrix(), $event->getQuantite(), $images);
        return $nouvelEvent;
    }

}

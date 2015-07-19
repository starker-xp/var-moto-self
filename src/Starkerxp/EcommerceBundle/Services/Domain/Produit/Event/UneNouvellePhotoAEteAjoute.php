<?php

namespace Starkerxp\EcommerceBundle\Services\Domain\Produit\Event;

use Starkerxp\CQRSESBundle\Services\Domain\AbstractEvent;

class UneNouvellePhotoAEteAjoute extends AbstractEvent
{

    private $imageProduitId;
    private $produitId;
    private $url;
    private $affichageParDefaut;

    public function __construct($imageProduitId, $produitId, $url, $affichageParDefaut)
    {
        $this->imageProduitId = $imageProduitId;
        $this->produitId = $produitId;
        $this->url = $url;
        $this->affichageParDefaut = $affichageParDefaut;
    }

    public function getAggregateId()
    {
        return $this->produitId;
    }

    public function getImageProduitId()
    {
        return $this->imageProduitId;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getAffichageParDefaut()
    {
        return $this->affichageParDefaut;
    }

    public function versTableau()
    {
        return [
            'imageProduitId' => $this->imageProduitId,
            'produitId' => $this->produitId,
            'url' => $this->url,
            'affichageParDefaut' => $this->affichageParDefaut,
        ];
    }

}

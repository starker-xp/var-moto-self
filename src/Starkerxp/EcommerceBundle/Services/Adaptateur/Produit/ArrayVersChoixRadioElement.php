<?php

namespace Starkerxp\EcommerceBundle\Services\Adaptateur\Produit;

class ArrayVersChoixRadioElement
{

    public function __construct(array $produitImages)
    {
        $this->produitImages = $produitImages;
    }

    /**
     * Convertit les objets d'une collection en un tableau de données.
     *
     * @return array
     */
    public function versDonneesFormulaire()
    {
        $donnees = [];
        foreach ($this->produitImages as $produitImage) {
            $donnees[$produitImage['id']] = $produitImage['url'];
        }
        return $donnees;
    }

}

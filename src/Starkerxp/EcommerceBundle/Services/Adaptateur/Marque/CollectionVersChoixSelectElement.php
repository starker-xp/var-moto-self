<?php

namespace Starkerxp\EcommerceBundle\Services\Adaptateur\Marque;

use Starkerxp\EcommerceBundle\Services\Domain\Marque\MarqueCollection;

class CollectionVersChoixSelectElement
{

    public function __construct(MarqueCollection $marqueCollection)
    {
        $this->marqueCollection = $marqueCollection->getCollection();
    }

    /**
     * Convertit les objets d'une collection en un tableau de données.
     *
     * @return array
     */
    public function versDonneesFormulaire()
    {
        $donnees = [];
        foreach ($this->marqueCollection as $marqueDto) {
            $donnees[$marqueDto->getId()] = $marqueDto->getLibelle();
        }
        return $donnees;
    }

}

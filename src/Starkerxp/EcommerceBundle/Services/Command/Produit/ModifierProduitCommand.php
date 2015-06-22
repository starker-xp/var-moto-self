<?php

namespace Starkerxp\EcommerceBundle\Services\Command\Produit;

use \Starkerxp\CQRSESBundle\Services\Command\CommandInterface;

class ModifierProduitCommand implements CommandInterface
{

    private $produitId;
    private $libelle;
    private $description;
    private $prix;
    private $quantite;
    private $marqueId;

    public function depuisDTO(DTOInterface $dto)
    {
        $this->setProduitId($dto->getId());
        $this->setLibelle($dto->getLibelle());
        $this->setDescription($dto->getDescription());
        $this->setPrix($dto->getPrix());
        $this->setQuantite($dto->getQuantite());
        $marque = $dto->getMarque();
        $this->setMarqueId($marque->getId());
    }

    /**
     * @return string
     */
    public function getProduitId()
    {
        return $this->produitId;
    }

    /**
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPrix()
    {
        return $this->prix;
    }

    public function getQuantite()
    {
        return $this->quantite;
    }

    public function getMarqueId()
    {
        return $this->marqueId;
    }

    public function setProduitId($produitId)
    {
        $this->produitId = $produitId;
        return $this;
    }

    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
        return $this;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function setPrix($prix)
    {
        $this->prix = $prix;
        return $this;
    }

    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
        return $this;
    }

    public function setMarqueId($marqueId)
    {
        $this->marqueId = $marqueId;
        return $this;
    }

}

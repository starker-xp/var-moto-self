<?php

namespace Starkerxp\EcommerceBundle\Services\Domain\Produit;

use Starkerxp\EcommerceBundle\Services\Persistence\Lecture\MarqueRepository;

class ProduitPOPO extends ProduitDTO
{

    private $marque;
    private $marqueRepository;
    private $imagesProduit;
    private $imageParDefaut;
    private $imagesProduitRepository;

    public function setMarqueRepository(MarqueRepository $marqueRepository)
    {
        $this->marqueRepository = $marqueRepository;
        return $this;
    }

    public function getMarque()
    {
        if (!$this->marque) {
            $marqueId = $this->getMarqueId();
            $this->marque = $this->marqueRepository->get($marqueId);
        }
        return $this->marque;
    }

    public function getImages()
    {
        if (!$this->imagesProduit) {
            $produitId = $this->getId();
            $this->imagesProduit = $this->imagesProduitRepository->getToutesLesImagesPourCeProduitId($produitId);
        }
        return $this->imagesProduit;
    }

    public function getImagesParDefaut()
    {
        if (!empty($this->imageParDefaut)) {
            return $this->imageParDefaut;
        }
        $images = $this->getImages();
        if (empty($images)) {
            return false;
        }
        foreach ($images as $image) {
            if ($image['affichage_par_defaut'] == 1) {
                return $this->imageParDefaut = $image['id'];
            }
        }
        return $this->imageParDefaut = $images[0]['id'];
    }

    public function setImagesProduitRepository($imagesProduitRepository)
    {
        $this->imagesProduitRepository = $imagesProduitRepository;
        return $this;
    }

}

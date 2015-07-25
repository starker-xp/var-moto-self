<?php

namespace Starkerxp\EcommerceBundle\Services\Query\Produit;

use Starkerxp\CQRSESBundle\Services\Query\QueryHandlerInterface;
use Starkerxp\CQRSESBundle\Services\Query\QueryInterface;
use Starkerxp\EcommerceBundle\Services\Domain\Produit\ProduitImagePOPO;
use Starkerxp\EcommerceBundle\Services\Persistence\Lecture\ImagesProduitRepository;

class ImageProduitParDefautQueryHandler implements QueryHandlerInterface
{

    private $imagesProduitRepository;

    public function __construct(ImagesProduitRepository $imageProduitRepository)
    {
        $this->imagesProduitRepository = $imageProduitRepository;
    }

    /**
     *
     * @param QueryInterface $imageProduitQuery
     *
     * @return ProduitImagePOPO
     */
    public function handle(QueryInterface $imageProduitQuery)
    {
        $imageProduit = $this->imagesProduitRepository->getImageParDefautPourCeProduit($imageProduitQuery->getProduitId());
        return $imageProduit;
    }

}

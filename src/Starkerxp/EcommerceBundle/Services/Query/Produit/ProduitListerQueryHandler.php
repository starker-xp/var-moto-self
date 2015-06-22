<?php

namespace Starkerxp\EcommerceBundle\Services\Query\Produit;

use Starkerxp\EcommerceBundle\Services\Persistence\Lecture\Produit\ProduitRepository;
use Starkerxp\CQRSESBundle\Services\Query\QueryHandlerInterface;
use Starkerxp\CQRSESBundle\Services\Query\QueryInterface;

class ProduitListerQueryHandler implements QueryHandlerInterface
{

    private $produitRepository;

    public function __construct(ProduitRepository $produitRepository)
    {
        $this->produitRepository = $produitRepository;
    }

    public function handle(QueryInterface $produitQuery)
    {
        $resultSets = $this->produitRepository->lister();
        return $resultSets->getCollection();
    }

}

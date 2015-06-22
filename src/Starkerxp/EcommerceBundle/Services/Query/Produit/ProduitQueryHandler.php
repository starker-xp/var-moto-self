<?php

namespace Starkerxp\EcommerceBundle\Services\Query\Produit;

use Starkerxp\EcommerceBundle\Services\Persistence\Lecture\ProduitRepository;
use Starkerxp\CQRSESBundle\Services\Query\QueryHandlerInterface;
use Starkerxp\CQRSESBundle\Services\Query\QueryInterface;

class ProduitQueryHandler implements QueryHandlerInterface
{

    private $produitRepository;

    public function __construct(ProduitRepository $produitRepository)
    {
        $this->produitRepository = $produitRepository;
    }

    public function handle(QueryInterface $produitQuery)
    {
        $row = $this->produitRepository->get($produitQuery->getId());
        return $row;
    }

}

<?php

namespace Starkerxp\EcommerceBundle\Services\Query\Produit;

use Starkerxp\CQRSESBundle\Services\Query\QueryHandlerInterface;
use Starkerxp\CQRSESBundle\Services\Query\QueryInterface;
use Starkerxp\EcommerceBundle\Services\Domain\Produit\ProduitPOPO;
use Starkerxp\EcommerceBundle\Services\Persistence\Lecture\ProduitRepository;

class ModifierProduitQueryHandler implements QueryHandlerInterface
{

    private $produitRepository;

    public function __construct(ProduitRepository $produitRepository)
    {
        $this->produitRepository = $produitRepository;
    }

    /**
     * On exécute la requête qui permet de retourner un DTO pour la modification du produit en question.
     *
     * @param QueryInterface $produitQuery
     *
     * @return ProduitPOPO
     */
    public function handle(QueryInterface $produitQuery)
    {
        $produit = $this->produitRepository->getPourModification($produitQuery->getId());
        return $produit;
    }

}

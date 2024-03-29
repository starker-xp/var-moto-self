<?php

namespace Starkerxp\EcommerceBundle\Services\Validator\Produit;

use Starkerxp\CQRSESBundle\Services\Query\QueryBus;
use Starkerxp\EcommerceBundle\Services\Command\Produit\SupprimerImageProduitCommand;
use Starkerxp\EcommerceBundle\Services\Query\Produit\ImageProduitParDefautQuery;
use Symfony\Component\HttpFoundation\Request;

class ValiderSuppressionImageProduit
{

    private $queryBus;
    private $request;
    private $command;
    private $erreurs = [];

    public function __construct(QueryBus $queryBus, Request $request, SupprimerImageProduitCommand $command)
    {
        $this->queryBus = $queryBus;
        $this->request = $request;
        $this->command = $command;
    }

    public function validate()
    {
        if (empty($this->command->getProduitId())) {
            $this->erreurs[] = "Veuillez définir un produitId";
            return false;
        }
        $produitImageParDefautQuery = new ImageProduitParDefautQuery();
        $produitImageParDefautQuery->setProduitId($this->command->getProduitId());
        $produitImageParDefaut = $this->queryBus->handle($produitImageParDefautQuery);
        if ($this->command->getImageProduitId() == $produitImageParDefaut->getId()) {
            $this->erreurs[] = "Vous ne pouvez supprimer l'image par défaut. Veuillez changer d'image par défaut avant.";
            return false;
        }
        return true;
    }

    public function getErreurs()
    {
        return $this->erreurs;
    }

}

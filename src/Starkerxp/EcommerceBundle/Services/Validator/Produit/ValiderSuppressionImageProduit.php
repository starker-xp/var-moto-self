<?php

namespace Starkerxp\EcommerceBundle\Services\Validator\Produit;

use Starkerxp\CQRSESBundle\Services\Query\QueryBus;
use Starkerxp\EcommerceBundle\Services\Query\Produit\ImageProduitParDefautQuery;
use Symfony\Component\HttpFoundation\Request;

class ValiderSuppressionImageProduit
{

    private $queryBus;
    private $request;
    private $produitId;
    private $imageProduitId;
    private $erreurs = [];

    public function __construct(QueryBus $queryBus, Request $request, $produitId, $imageProduitId)
    {
        $this->queryBus = $queryBus;
        $this->request = $request;
        $this->produitId = $produitId;
        $this->imageProduitId = $imageProduitId;
    }

    public function validate()
    {
        if (empty($this->produitId)) {
            $this->erreurs[] = "Veuillez définir un produitId";
            return false;
        }
        $produitImageParDefautQuery = new ImageProduitParDefautQuery();
        $produitImageParDefautQuery->setProduitId($this->produitId);
        $produitImageParDefaut = $this->queryBus->handle($produitImageParDefautQuery);
        if ($this->imageProduitId == $produitImageParDefaut->getId()) {
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

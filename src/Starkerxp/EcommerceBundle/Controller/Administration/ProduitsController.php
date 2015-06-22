<?php

namespace Starkerxp\EcommerceBundle\Controller\Administration;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProduitsController extends Controller
{

    /**
     * @Route("/produits/", name="liste_produits")
     * @Method({"GET"})
     */
    public function indexAction()
    {
        $produitQuery = new ProduitListerQuery();
        $queryBus = $this->get('bus.event.produit');
        $produits = $queryBus->handle($produitQuery);

        $render = $this->render('StarkerxpEcommerceBundle:Produits:index.html.twig', [
            'produits' => $produits,
        ]);
        return $render;
    }

    /**
     * @Route("/produits/ajouter.html", name="formulaire_creation_produit")
     * @Method({"GET"})
     */
    public function createAction()
    {
        return 'form_creation';
    }

    /**
     * @Route("/produits/ajouter.html", name="creation_produit")
     * @Method({"POST"})
     */
    public function postAction()
    {

    }

    /**
     * @Route("/produits/modifier/{produitId}.html", name="formulaire_modification_produit", requirements ={"produitId" = "[a-z0-9]{8}\-[a-z0-9]{4}\-[a-z0-9]{4}\-[a-z0-9]{4}\-[a-z0-9]{12}"})
     * @Method({"GET"})
     */
    public function editAction($produitId)
    {
        return $produitId;
    }

    /**
     * @Route("/produits/modifier/{produitId}.html", name="modification_produit", requirements ={"produitId" = "[a-z0-9]{8}\-[a-z0-9]{4}\-[a-z0-9]{4}\-[a-z0-9]{4}\-[a-z0-9]{12}"})
     * @Method({"PUT"})
     */
    public function putAction($produitId)
    {

    }

    /**
     * @Route("/produits/supprimer/{produitId}.html", name="suppression_produit", requirements ={"produitId" = "[a-z0-9]{8}\-[a-z0-9]{4}\-[a-z0-9]{4}\-[a-z0-9]{4}\-[a-z0-9]{12}"})
     * @Method({"DELETE"})
     */
    public function deleteAction(Request $request, $produitId)
    {
        if (!$this->isCsrfTokenValid('', $request->get('_token'))) {
            return new JsonResponse(["message" => "Erreur token"], 500);
        }

        $entite = new SupprimerProduitCommand();
        $entite->setProduitId($produitId);

        $commandBus = $this->get('bus.command.produit');
        $commandBus->handle($entite);

        return new JsonResponse(["message" => "Produit supprimé"]);
    }

}

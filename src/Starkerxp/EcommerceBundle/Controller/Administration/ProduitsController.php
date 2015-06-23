<?php

namespace Starkerxp\EcommerceBundle\Controller\Administration;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Starkerxp\EcommerceBundle\Services\Command\Produit\CreerProduitCommand;
use Starkerxp\EcommerceBundle\Services\Command\Produit\ModifierProduitCommand;
use Starkerxp\EcommerceBundle\Services\Command\Produit\SupprimerProduitCommand;
use Starkerxp\EcommerceBundle\Services\Query\Produit\ProduitListerQuery;
use Starkerxp\EcommerceBundle\Services\Query\Produit\ProduitQuery;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

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
        $form = $this->createForm($this->get('form.ajouter.produit'), new CreerProduitCommand(), [
            'action' => $this->generateUrl('creation_produit'),
        ]);
        $render = $this->render('StarkerxpEcommerceBundle:Produits:create.html.twig', [
            'form' => $form->createView(),
        ]);
        return $render;
    }

    /**
     * @Route("/produits/ajouter.html", name="creation_produit")
     * @Method({"POST"})
     */
    public function postAction(Request $request)
    {
        $form = $this->createForm($this->get('form.ajouter.produit'), new CreerProduitCommand(), [
            'action' => $this->generateUrl('creation_produit'),
        ]);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $commandBus = $this->get('bus.command.produit');
            $commandBus->handle($form->getData());
            return $this->redirect($this->generateUrl('liste_produits'));
        }

        $render = $this->render('StarkerxpEcommerceBundle:Produits:create.html.twig', [
            'form' => $form->createView(),
        ]);

        return $render;
    }

    /**
     * @Route("/produits/modifier/{produitId}.html", name="formulaire_modification_produit", requirements ={"produitId" = "[a-z0-9]{8}\-[a-z0-9]{4}\-[a-z0-9]{4}\-[a-z0-9]{4}\-[a-z0-9]{12}"})
     * @Method({"GET"})
     */
    public function editAction($produitId)
    {
        $produitQuery = new ProduitQuery();
        $produitQuery->setId($produitId);
        $queryBus = $this->get('bus.event.produit');
        $produit = $queryBus->handle($produitQuery);

        $entite = new ModifierProduitCommand();
        $entite->depuisDTO($produit);

        $form = $this->createForm($this->get('form.modifier.produit'), $entite, [
            'action' => $this->generateUrl('modification_produit', ['produitId' => $produitId]),
        ]);

        $render = $this->render('StarkerxpEcommerceBundle:Produits:edit.html.twig', [
            'form' => $form->createView(),
        ]);

        return $render;
    }

    /**
     * @Route("/produits/modifier/{produitId}.html", name="modification_produit", requirements ={"produitId" = "[a-z0-9]{8}\-[a-z0-9]{4}\-[a-z0-9]{4}\-[a-z0-9]{4}\-[a-z0-9]{12}"})
     * @Method({"PUT"})
     */
    public function putAction(Request $request, $produitId)
    {
        $entite = new ModifierProduitCommand();
        $entite->setProduitId($produitId);

        $form = $this->createForm($this->get('form.modifier.produit'), $entite, [
            'action' => $this->generateUrl('modification_produit', ['produitId' => $produitId]),
        ]);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $commandBus = $this->get('bus.command.produit');
            $commandBus->handle($form->getData());
            return $this->redirect($this->generateUrl('liste_produits'));
        }

        $render = $this->render('StarkerxpEcommerceBundle:Produits:create.html.twig', [
            'form' => $form->createView(),
        ]);
        return $render;
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

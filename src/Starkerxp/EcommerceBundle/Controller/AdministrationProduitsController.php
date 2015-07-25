<?php

namespace Starkerxp\EcommerceBundle\Controller;

use Starkerxp\EcommerceBundle\Services\Command\Produit\CreerProduitCommand;
use Starkerxp\EcommerceBundle\Services\Command\Produit\ModifierProduitCommand;
use Starkerxp\EcommerceBundle\Services\Command\Produit\SupprimerImageProduitCommand;
use Starkerxp\EcommerceBundle\Services\Command\Produit\SupprimerProduitCommand;
use Starkerxp\EcommerceBundle\Services\Query\Produit\ModifierProduitQuery;
use Starkerxp\EcommerceBundle\Services\Query\Produit\ProduitListerQuery;
use Starkerxp\EcommerceBundle\Services\Validator\Produit\ValiderSuppressionImageProduit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AdministrationProduitsController extends Controller
{

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

    public function postAction(Request $request)
    {
        $form = $this->createForm($this->get('form.ajouter.produit'), new CreerProduitCommand(), [
            'action' => $this->generateUrl('creation_produit'),
        ]);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $commandForm = $form->getData();

            $uploader = $this->get('uploader.produits');
            $listeUrls = $uploader->upload();
            $commandForm->setImages($listeUrls);

            $commandBus = $this->get('bus.command.produit');
            $commandBus->handle($commandForm);
            return $this->redirect($this->generateUrl('liste_produits'));
        }

        $render = $this->render('StarkerxpEcommerceBundle:Produits:create.html.twig', [
            'form' => $form->createView(),
        ]);

        return $render;
    }

    public function editAction($produitId)
    {
        $produitQuery = new ModifierProduitQuery();
        $produitQuery->setId($produitId);

        $queryBus = $this->get('bus.event.produit');
        $produit = $queryBus->handle($produitQuery);

        $command = new ModifierProduitCommand();
        $command->depuisDTO($produit);

        $form = $this->createForm($this->get('form.modifier.produit'), $command, [
            'action' => $this->generateUrl('modification_produit', ['produitId' => $produitId]),
        ]);

        $render = $this->render('StarkerxpEcommerceBundle:Produits:edit.html.twig', [
            'form' => $form->createView(),
            'produitId' => $produitId,
        ]);

        return $render;
    }

    public function putAction(Request $request, $produitId)
    {
        $command = new ModifierProduitCommand();
        $command->setProduitId($produitId);

        $form = $this->createForm($this->get('form.modifier.produit'), $command, [
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
            'produitId' => $produitId,
        ]);
        return $render;
    }

    public function deleteAction(Request $request, $produitId)
    {
        if (!$this->isCsrfTokenValid('', $request->get('_token'))) {
            return new JsonResponse(["message" => "Erreur token"], 500);
        }

        $command = new SupprimerProduitCommand();
        $command->setProduitId($produitId);

        $commandBus = $this->get('bus.command.produit');
        $commandBus->handle($command);

        return new JsonResponse(["message" => "Produit supprimé"]);
    }

    public function deleteImageProduitAction(Request $request, $imageProduitId)
    {
        if (!$this->isCsrfTokenValid('', $request->get('_token'))) {
            return new JsonResponse(["message" => "Le jeton d'authentification n'est pas valide."], 500);
        }
        $command = new SupprimerImageProduitCommand();
        $command->setImageProduitId($imageProduitId);
        $command->setProduitId($request->get('produitId'));

        $validator = new ValiderSuppressionImageProduit($this->get('bus.event.produit'), $request, $command);
        if (!$validator->validate()) {
            return new JsonResponse(["message" => $validator->getErreurs()], 500);
        }

        $commandBus = $this->get('bus.command.produit');
        $commandBus->handle($command);

        return new JsonResponse(["message" => "La photo a bien été supprimée !"]);
    }

}

<?php

namespace Starkerxp\EcommerceBundle\Controller\Administration;

use Starkerxp\EcommerceBundle\Forms\Marque\CreationMarqueForm;
use Starkerxp\EcommerceBundle\Forms\Marque\ModificationMarqueForm;
use Starkerxp\EcommerceBundle\Services\Command\Marque\CreationMarqueCommand;
use Starkerxp\EcommerceBundle\Services\Command\Marque\ModificationMarqueCommand;
use Starkerxp\EcommerceBundle\Services\Command\Marque\SupprimerMarqueCommand;
use Starkerxp\EcommerceBundle\Services\Query\Marque\MarqueListerQuery;
use Starkerxp\EcommerceBundle\Services\Query\Marque\MarqueQuery;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class MarquesController extends Controller
{

    /**
     * @Route("/marques/", name="liste_marques")
     * @Method({"GET"})
     */
    public function indexAction()
    {
        $marqueQuery = new MarqueListerQuery();
        $queryBus = $this->get('bus.event.marque');
        $marques = $queryBus->handle($marqueQuery);
        $render = $this->render('StarkerxpEcommerceBundle:Marques:index.html.twig', [
            'marques' => $marques,
        ]);
        return $render;
    }

    /**
     * @Route("/marques/ajouter.html", name="formulaire_creation_marque")
     * @Method({"GET"})
     */
    public function createAction()
    {
        $form = $this->createForm(new CreationMarqueForm(), new CreationMarqueCommand(), [
            'action' => $this->generateUrl('creation_marque'),
        ]);

        $render = $this->render('StarkerxpEcommerceBundle:Marques:create.html.twig', [
            'form' => $form->createView(),
        ]);
        return $render;
    }

    /**
     * @Route("/marques/ajouter.html", name="creation_marque")
     * @Method({"POST"})
     */
    public function postAction(Request $request)
    {
        $form = $this->createForm(new CreationMarqueForm(), new CreationMarqueCommand(), [
            'action' => $this->generateUrl('creation_marque'),
        ]);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $commandBus = $this->get('bus.command.marque');
            $commandBus->handle($form->getData());
            return $this->redirect($this->generateUrl('liste_marques'));
        }

        $render = $this->render('StarkerxpEcommerceBundle:Marques:create.html.twig', [
            'form' => $form->createView(),
        ]);
        return $render;
    }

    /**
     * @Route("/marques/modifier/{marqueId}.html", name="formulaire_modification_marque", requirements ={"marqueId" = "[a-z0-9]{8}\-[a-z0-9]{4}\-[a-z0-9]{4}\-[a-z0-9]{4}\-[a-z0-9]{12}"})
     * @Method({"GET"})
     */
    public function editAction($marqueId)
    {
        $marqueQuery = new MarqueQuery();
        $marqueQuery->setId($marqueId);
        $queryBus = $this->get('bus.event.marque');
        $marque = $queryBus->handle($marqueQuery);

        $entite = new ModificationMarqueCommand();
        $entite->setMarqueId($marque->getId());
        $entite->setLibelle($marque->getLibelle());

        $form = $this->createForm(new ModificationMarqueForm(), $entite, [
            'action' => $this->generateUrl('modification_marque', ['marqueId' => $marqueId]),
        ]);

        $render = $this->render('StarkerxpEcommerceBundle:Marques:edit.html.twig', [
            'form' => $form->createView(),
        ]);

        return $render;
    }

    /**
     * @Route("/marques/modifier/{marqueId}.html", name="modification_marque", requirements ={"marqueId" = "[a-z0-9]{8}\-[a-z0-9]{4}\-[a-z0-9]{4}\-[a-z0-9]{4}\-[a-z0-9]{12}"})
     * @Method({"PUT"})
     */
    public function putAction(Request $request, $marqueId)
    {
        $entite = new ModificationMarqueCommand();
        $entite->setMarqueId($marqueId);

        $form = $this->createForm(new ModificationMarqueForm(), $entite, [
            'action' => $this->generateUrl('modification_marque', ['marqueId' => $marqueId]),
        ]);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $commandBus = $this->get('bus.command.marque');
            $commandBus->handle($form->getData());
            return $this->redirect($this->generateUrl('liste_marques'));
        }

        $render = $this->render('StarkerxpEcommerceBundle:Marques:create.html.twig', [
            'form' => $form->createView(),
        ]);
        return $render;
    }

    /**
     * @Route("/marques/supprimer/{marqueId}.html", name="suppression_marque", requirements ={"marqueId" = "[a-z0-9]{8}\-[a-z0-9]{4}\-[a-z0-9]{4}\-[a-z0-9]{4}\-[a-z0-9]{12}"})
     * @Method({"DELETE"})
     */
    public function deleteAction(Request $request, $marqueId)
    {
        if (!$this->isCsrfTokenValid('', $request->get('_token'))) {
            return new JsonResponse(["message" => "Erreur token"], 500);
        }

        $entite = new SupprimerMarqueCommand();
        $entite->setMarqueId($marqueId);

        $commandBus = $this->get('bus.command.marque');
        $commandBus->handle($entite);

        return new JsonResponse(["message" => "Marque supprimé"]);
    }

}

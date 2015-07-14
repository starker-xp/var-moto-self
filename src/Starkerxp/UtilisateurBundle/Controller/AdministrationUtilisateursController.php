<?php

namespace Starkerxp\UtilisateurBundle\Controller;

use Starkerxp\UtilisateurBundle\Services\Command\Utilisateur\CreerUtilisateurCommand;
use Starkerxp\UtilisateurBundle\Services\Command\Utilisateur\ModifierUtilisateurCommand;
use Starkerxp\UtilisateurBundle\Services\Command\Utilisateur\SupprimerUtilisateurCommand;
use Starkerxp\UtilisateurBundle\Services\Query\Utilisateur\UtilisateurListerQuery;
use Starkerxp\UtilisateurBundle\Services\Query\Utilisateur\UtilisateurQuery;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AdministrationUtilisateursController extends Controller
{

    public function indexAction()
    {
        $utilisateurQuery = new UtilisateurListerQuery();
        $queryBus = $this->get('bus.event.utilisateur');
        $utilisateurs = $queryBus->handle($utilisateurQuery);

        $render = $this->render('StarkerxpUtilisateurBundle:Utilisateurs:index.html.twig', [
            'utilisateurs' => $utilisateurs,
        ]);
        return $render;
    }

    public function createAction()
    {
        $form = $this->createForm($this->get('form.ajouter.utilisateur'), new CreerUtilisateurCommand(), [
            'action' => $this->generateUrl('creation_utilisateur'),
        ]);
        $render = $this->render('StarkerxpUtilisateurBundle:Utilisateurs:create.html.twig', [
            'form' => $form->createView(),
        ]);
        return $render;
    }

    public function postAction(Request $request)
    {
        $form = $this->createForm($this->get('form.ajouter.utilisateur'), new CreerUtilisateurCommand(), [
            'action' => $this->generateUrl('creation_utilisateur'),
        ]);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $commandBus = $this->get('bus.command.utilisateur');
            $commandBus->handle($form->getData());
            return $this->redirect($this->generateUrl('liste_utilisateurs'));
        }

        $render = $this->render('StarkerxpUtilisateurBundle:Utilisateurs:create.html.twig', [
            'form' => $form->createView(),
        ]);

        return $render;
    }

    public function editAction($utilisateurId)
    {
        $utilisateurQuery = new UtilisateurQuery();
        $utilisateurQuery->setId($utilisateurId);
        $queryBus = $this->get('bus.event.utilisateur');
        $utilisateur = $queryBus->handle($utilisateurQuery);

        $entite = new ModifierUtilisateurCommand($utilisateurId);
        $entite->depuisDTO($utilisateur);

        $form = $this->createForm($this->get('form.modifier.utilisateur'), $entite, [
            'action' => $this->generateUrl('modification_utilisateur', ['utilisateurId' => $utilisateurId]),
        ]);

        $render = $this->render('StarkerxpUtilisateurBundle:Utilisateurs:edit.html.twig', [
            'form' => $form->createView(),
            'utilisateur' => $utilisateur,
        ]);

        return $render;
    }

    public function putAction(Request $request, $utilisateurId)
    {
        $utilisateurQuery = new UtilisateurQuery();
        $utilisateurQuery->setId($utilisateurId);
        $queryBus = $this->get('bus.event.utilisateur');
        $utilisateur = $queryBus->handle($utilisateurQuery);

        $entite = new ModifierUtilisateurCommand($utilisateurId);

        $form = $this->createForm($this->get('form.modifier.utilisateur'), $entite, [
            'action' => $this->generateUrl('modification_utilisateur', ['utilisateurId' => $utilisateurId]),
        ]);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $commandBus = $this->get('bus.command.utilisateur');
            $commandBus->handle($form->getData());
            return $this->redirect($this->generateUrl('liste_utilisateurs'));
        }

        $render = $this->render('StarkerxpUtilisateurBundle:Utilisateurs:edit.html.twig', [
            'form' => $form->createView(),
            'utilisateur' => $utilisateur,
        ]);
        return $render;
    }

    public function deleteAction(Request $request, $utilisateurId)
    {
        if (!$this->isCsrfTokenValid('', $request->get('_token'))) {
            return new JsonResponse(["message" => "Erreur token"], 500);
        }

        $entite = new SupprimerUtilisateurCommand();
        $entite->setUtilisateurId($utilisateurId);

        $commandBus = $this->get('bus.command.utilisateur');
        $commandBus->handle($entite);

        return new JsonResponse(["message" => "Utilisateur supprimé"]);
    }

}

<?php

namespace Starkerxp\UtilisateurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UtilisateurController extends Controller
{

    public function monCompteAction()
    {
        $utilisateur = $this->get('security.context')->getToken()->getUser();
    }

    public function modifierMesInformationsAction()
    {
        $utilisateur = $this->get('security.context')->getToken()->getUser();
    }

    public function putModifierMesInformationsAction()
    {

    }

    public function modifierMonMotDePasseAction()
    {
        $utilisateur = $this->get('security.context')->getToken()->getUser();
    }

    public function putModifierMonMotDePasseAction()
    {

    }

    public function modifierMesPreferencesDeContactAction()
    {
        $utilisateur = $this->get('security.context')->getToken()->getUser();
    }

    public function putModifierMesPreferencesDeContactAction()
    {

    }

}

<?php

namespace Starkerxp\VarMotoSelfBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

    public function indexAction()
    {
        $render = $this->render('StarkerxpVarMotoSelfBundle:Default:homepage.html.twig', []);
        return $render;
    }

    public function faqAction()
    {
        $render = $this->render('StarkerxpVarMotoSelfBundle:Default:faq.html.twig', []);
        return $render;
    }

    public function mentionsLegalesAction()
    {
        $render = $this->render('StarkerxpVarMotoSelfBundle:Default:mentions_legales.html.twig', []);
        return $render;
    }

    public function contactAction()
    {
        $render = $this->render('StarkerxpVarMotoSelfBundle:Default:contact.html.twig', []);
        return $render;
    }

}

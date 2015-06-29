<?php

namespace Starkerxp\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

    public function indexAction()
    {
        $render = $this->render('StarkerxpEcommerceBundle:Default:homepage.html.twig', []);
        return $render;
    }

    public function faqAction()
    {
        return $this->render('StarkerxpEcommerceBundle:Default:faq.html.twig', []);
    }

    public function mentionsLegalesAction()
    {
        return $this->render('StarkerxpEcommerceBundle:Default:mentions_legales.html.twig', []);
    }

    public function contactAction()
    {
        return $this->render('StarkerxpEcommerceBundle:Default:contact.html.twig', []);
    }

}

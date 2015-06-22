<?php

namespace Starkerxp\EcommerceBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

    /**
     * @Route("/", name="homepage")
     * @Method({"GET"})
     */
    public function indexAction()
    {
        return $this->render('StarkerxpEcommerceBundle:Default:homepage.html.twig');
    }

    /**
     * @Route("/faq.html", name="faq")
     * @Method({"GET"})
     */
    public function faqAction()
    {
        return $this->render('StarkerxpEcommerceBundle:Default:faq.html.twig', []);
    }

    /**
     * @Route("/mentions-legales.html", name="mentions_legales")
     * @Method({"GET"})
     */
    public function mentionsLegalesAction()
    {
        return $this->render('StarkerxpEcommerceBundle:Default:mentions_legales.html.twig', []);
    }

    /**
     * @Route("/contact.html", name="contact")
     * @Method({"GET"})
     */
    public function contactAction()
    {
        return $this->render('StarkerxpEcommerceBundle:Default:contact.html.twig', []);
    }

}

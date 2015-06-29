<?php

namespace Starkerxp\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdministrationController extends Controller
{

    public function indexAction()
    {
        $render = $this->render('StarkerxpEcommerceBundle:Administration:index.html.twig', []);
        return $render;
    }

}

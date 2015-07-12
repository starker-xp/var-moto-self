<?php

namespace Starkerxp\VarMotoSelfBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdministrationController extends Controller
{

    public function indexAction()
    {
        $render = $this->render('StarkerxpVarMotoSelfBundle:Administration:index.html.twig', []);
        return $render;
    }

}

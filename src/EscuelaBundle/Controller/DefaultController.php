<?php

namespace EscuelaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Escuela\Default\index.html.twig');
    }
}

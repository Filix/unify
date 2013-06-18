<?php

namespace Unify\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('UnifyWebBundle:Default:index.html.twig', array('name' => $name));
    }
}

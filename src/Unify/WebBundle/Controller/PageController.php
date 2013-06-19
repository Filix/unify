<?php

namespace Unify\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class PageController extends Controller
{
    /**
     * @Route("/",name="homepage")
     * @Template()
     */
    public function indexAction()
    {
        return $this->render('UnifyWebBundle:Page:index.html.twig');
    }
    
    /**
     * @Route("/about",name="about")
     * @Template()
     */
    public function aboutAction()
    {
        return $this->render('UnifyWebBundle:Page:about.html.twig');
    }
    
    /**
     * @Route("/contact",name="contact")
     * @Template()
     */
    public function contactAction()
    {
        return $this->render('UnifyWebBundle:Page:contact.html.twig');
    }
}

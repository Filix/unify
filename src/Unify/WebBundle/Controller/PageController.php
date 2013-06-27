<?php

namespace Unify\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Unify\WebBundle\Entity\Message;

class PageController extends BaseController
{
    /**
     * @Route("/",name="homepage")
     * @Template("UnifyWebBundle:Page:index.html.twig")
     */
    public function indexAction()
    {
        $products = $this->getProductRepository()->getLatestProducts(4);
        return array('products' => $products);
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
     * @Template("UnifyWebBundle:Page:contact.html.twig")
     */
    public function contactAction()
    {
        $message = new Message();
        
        $form = $this->createFormBuilder($message)
                ->add('name', 'text', array('label' => 'Your Name:', 'trim' => true))
                ->add('email', 'email', array('label' => 'Your Email:', 'trim' => true))
                ->add('content', 'textarea', array('label' => 'Your Message:', 'trim' => true))
                ->getForm();
        
        if($this->getRequest()->isMethod("POST")){
            $form->bind($this->getRequest());
            if($form->isValid()){
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($form->getData());
                $em->flush();
                $this->get('session')->getFlashBag()
                        ->add('notice', 'Success!');
                return $this->redirect($this->generateUrl('contact'));
            }

        }
        return array('form' => $form->createView());
    }
}

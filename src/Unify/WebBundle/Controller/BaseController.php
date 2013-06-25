<?php
namespace Unify\WebBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller{
    
    public function getCategoryRepository(){
        return $this->getDoctrine()->getRepository('UnifyWebBundle:Category');
    }
    
    public function getArticleRepository(){
        return $this->getDoctrine()->getRepository('UnifyWebBundle:Article');
    }
}

?>

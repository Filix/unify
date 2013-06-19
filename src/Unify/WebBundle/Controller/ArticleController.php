<?php


namespace Unify\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ArticleController extends Controller{
    
    /**
     * @Route("/news/{page}", requirements={"page"="\d+"},defaults={"page"="1"}, name="news_list")
     * @Template()
     */
    public function newsListAction($page)
    {
        return $this->render('UnifyWebBundle:Article:news_list.html.twig');
    }
    
    /**
     * @Route("/news/{slug}", requirements={"slug"="[a-zA-Z0-9\-_]+"}, name="news")
     * @Template()
     */
    public function newsAction($slug)
    {
        return $this->render('UnifyWebBundle:Article:news.html.twig');
    }
    
    /**
     * @Route("/products/{page}", requirements={"page"="\d+"},defaults={"page"="1"}, name="product_list")
     * @Template()
     */
    public function productListAction($page)
    {
        return $this->render('UnifyWebBundle:Article:product_list.html.twig');
    }
    
    /**
     * @Route("/products/{slug}/{page}", requirements={"slug"="[a-zA-Z0-9\-_]+", "page"="\d+"},defaults={"page"="1"}, name="product_category")
     * @Template()
     */
    public function productCategoryAction($slug, $page)
    {
        return $this->render('UnifyWebBundle:Article:product_category.html.twig');
    }
    
    /**
     * @Route("/product/{slug}", requirements={"slug"="[a-zA-Z0-9\-_]+"}, name="product")
     * @Template()
     */
    public function productAction($slug)
    {
        return $this->render('UnifyWebBundle:Article:product.html.twig');
    }
}

?>

<?php


namespace Unify\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Unify\WebBundle\Entity\Article;

class ArticleController extends BaseController{
    
    /**
     * @Route("/news/{page}", requirements={"page"="\d+"},defaults={"page"="1"}, name="news_list")
     * @Template("UnifyWebBundle:Article:news_list.html.twig")
     */
    public function newsListAction($page)
    {
        $this->get('twig')->addGlobal('menu', 'news');
        $pager = $this->get('knp_paginator')
                ->paginate($this->getArticleRepository()->findBy(array(), array('created_at' => 'desc')),
                        $page,
                        15);
        return array('pager' => $pager);
    }
    
    /**
     * @Route("/news/{slug}", requirements={"slug"="[a-zA-Z0-9\-_]+"}, name="news")
     * @Template("UnifyWebBundle:Article:news.html.twig")
     */
    public function newsAction($slug)
    {
        $this->get('twig')->addGlobal('menu', 'news');
        if(!$news = $this->getArticleRepository()->findOneBy(array('slug' => strtolower($slug)))){
            throw new NotFoundHttpException('Sorry! The page does not exist!');
        }
        return array('news' => $news);
    }
    
    /**
     * @Route("/products/{page}", requirements={"page"="\d+"},defaults={"page"="1"}, name="product_list")
     * @Template("UnifyWebBundle:Article:product_list.html.twig")
     */
    public function productListAction($page)
    {
        $this->get('twig')->addGlobal('menu', 'product');
        $pagesize = 2;
        $return = array();
        $return['pager'] = $this->get('knp_paginator')
             ->paginate($this->getProductRepository()->getProducts(),
                        $page,
                        $pagesize
             );
        
        return $return;
    }
    
    /**
     * @Route("/products/{slug}/{page}", requirements={"slug"="[a-zA-Z0-9\-_]+", "page"="\d+"},defaults={"page"="1"}, name="product_category")
     * @Template("UnifyWebBundle:Article:product_category.html.twig")
     */
    public function productCategoryAction($slug, $page)
    {
        $this->get('twig')->addGlobal('menu', 'product');
        if(!$category = $this->getCategoryRepository()->findOneBy(array("slug" => strtolower($slug)))){
            throw new NotFoundHttpException('Sorry! The page does not exist!');
        }
        
        $return = array();
        $return['pager'] = $this->get('knp_paginator')
                ->paginate($this->getProductRepository()->findBy(array('category' => $category), array("created_at" => "desc")),
                        $page, 20);
        return $return;
    }
    
    /**
     * @Route("/product/{slug}", requirements={"slug"="[a-zA-Z0-9\-_]+"}, name="product")
     * @Template("UnifyWebBundle:Article:product.html.twig")
     */
    public function productAction($slug)
    {
        $this->get('twig')->addGlobal('menu', 'product');
        if(!$product = $this->getProductRepository()->findOneBy(array('slug' => strtolower($slug)))){
            throw new NotFoundHttpException('Sorry! The page does not exist!');
        }
        return array('product' => $product);
    }
}

?>

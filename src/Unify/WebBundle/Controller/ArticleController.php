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
        $news = $this->get('knp_paginator')
                ->paginate($this->getArticleRepository()->findBy(array('type' => Article::$NEWS_TYPE), array('created_at' => 'desc')),
                        $page,
                        15);
        return array('news' => $news);
    }
    
    /**
     * @Route("/news/{slug}", requirements={"slug"="[a-zA-Z0-9\-_]+"}, name="news")
     * @Template("UnifyWebBundle:Article:news.html.twig")
     */
    public function newsAction($slug)
    {
        if(!$news = $this->getArticleRepository()->findOneBy(array('slug' => strtolower($slug), 'type' => Article::$NEWS_TYPE))){
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
        $pagesize = 10;
        $return = array();
        $return['categories'] = $this->get('knp_paginator')
             ->paginate($this->getCategoryRepository()->findBy(array(), array('order' => 'desc')),
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
        if(!$category = $this->getCategoryRepository()->findOneBy(array("slug" => strtolower($slug)))){
            throw new NotFoundHttpException('Sorry! The page does not exist!');
        }
        
        $return = array();
        $return['products'] = $this->get('knp_paginator')
                ->paginate($this->getArticleRepository()->findBy(array('category' => $category)),
                        $page, 20);
        $return['categories'] = $this->getCategoryRepository()->findAll();
        return $return;
    }
    
    /**
     * @Route("/product/{slug}", requirements={"slug"="[a-zA-Z0-9\-_]+"}, name="product")
     * @Template("UnifyWebBundle:Article:product.html.twig")
     */
    public function productAction($slug)
    {
        if(!$product = $this->getArticleRepository()->findOneBy(array('slug' => strtolower($slug), 'type' => Article::$PRODUCT_TYPE))){
            throw new NotFoundHttpException('Sorry! The page does not exist!');
        }
        return array('product' => $product);
    }
}

?>

<?php
namespace Unify\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Unify\WebBundle\Entity\Article;

class WidgetController extends BaseController{
    
    /**
     * @Template("UnifyWebBundle:Widget:latest_news.html.twig")
     */
    public function latestNewsAction($num = 3){
        $news = $this->getArticleRepository()->findBy(array('type' => Article::$NEWS_TYPE), array("created_at" => "desc"), $num);
        return array('news' => $news);
    }
    
    /**
     * @Template("UnifyWebBundle:Widget:categories.html.twig")
     */
    public function categoriesAction(){
        $categories = $this->getCategoryRepository()->findBy(array(), array("order" => "desc"));
        return array('categories' => $categories);
    }
    
}

?>

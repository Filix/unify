<?php
namespace Unify\BackendBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;

class ArticleAdminController extends Controller
{
    public function configure(){
        parent::configure();
//        var_dump($this->admin->getSubject());
        $this->admin->setContainer($this->container);
    }
}
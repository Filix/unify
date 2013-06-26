<?php

namespace Unify\BackendBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class ProductAdmin extends ArticleAdmin{
    
    
    
    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('title', NULL, array('label' => 'Title', 'required' => true))
                ->add('slug', NULL, array('label' => 'Slug', 'required' => true))
                ->add('content', NULL, array('label' => 'Content', 'required' => true))
                ->add('category', null, array('label' => 'Category', 'required' => true))
            ;
    }
    
    protected function configureListFields(ListMapper $listMapper) {
        $query = $this->getModelManager()
            ->getEntityManager('Unify\WebBundle\Entity\Article')
            ->createQueryBuilder()
            ->select("a")
            ->from("UnifyWebBundle:Article","a")
            ->where("a.type=:type")
            ->setParameter(':type',  \Unify\WebBundle\Entity\Article::$PRODUCT_TYPE);
        
        $listMapper
                ->addIdentifier('id')
                ->add('slug')
                ->add('title')
                ->add('created_at')
                ->add('type', null, array('query_builder' => $query))
        ;
    }
    
    
}

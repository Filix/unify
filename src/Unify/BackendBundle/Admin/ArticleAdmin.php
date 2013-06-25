<?php

namespace Unify\BackendBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
class ArticleAdmin extends Admin{
    
    public function __construct($code, $class, $baseControllerName) {
        parent::__construct($code, $class, $baseControllerName);

        if (!$this->hasRequest()) {
            $this->datagridValues = array(
                '_page' => 1,
                '_sort_order' => 'desc', // sort direction
                '_sort_by' => 'created_at', // field name
                '_per_page'=> 25 
            );
        }
    }
    
    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('title', NULL, array('label' => 'Title', 'required' => true))
                ->add('slug', NULL, array('label' => 'Slug', 'required' => true))
                ->add('content', NULL, array('label' => 'Content', 'required' => true))
                ->add('type');
    }
    
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('slug')
                ->add('title')
                ->add('content')
                ->add('type')
                ->add('created_at')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->addIdentifier('id')
                ->add('slug')
                ->add('title')
                ->add('created_at')
                ->add('type')
        ;
    }
}

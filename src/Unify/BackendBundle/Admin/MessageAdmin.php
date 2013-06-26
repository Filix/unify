<?php

namespace Unify\BackendBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class MessageAdmin extends Admin{
    
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
                ->add('name', NULL, array('label' => 'Name', 'required' => true))
                ->add('email', NULL, array('label' => 'Email', 'required' => true))
                ->add('content', NULL, array('label' => 'Content', 'required' => true))
                ;
    }
    
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('name')
                ->add('email')
                ->add('content')
                
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->addIdentifier('id')
                ->add('name')
                ->add('email')
                ->add('created_at')
        ;
    }
}

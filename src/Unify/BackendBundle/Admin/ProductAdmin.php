<?php

namespace Unify\BackendBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductAdmin extends ArticleAdmin{
    
    
    
    protected function configureFormFields(FormMapper $formMapper) {
        $options = array('required' => false, 'data_class' => null);
        if (($subject = $this->getSubject()) && $subject->getImg()) {
            $path = $subject->getImg();
            $options['help'] = '<img width="200" src="/uploads/' . $path . '" />';
        }
        $formMapper
                ->add('title', NULL, array('label' => 'Title', 'required' => true))
                ->add('slug', NULL, array('label' => 'Slug', 'required' => true))
                ->add('content', NULL, array('label' => 'Content', 'required' => true, 'attr'=>array('rows'=>20)))
                ->add('img', 'file', $options)
                ->add('category', null, array('label' => 'Category', 'required' => true))
            ;
    }
    
    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->addIdentifier('id')
                ->add('slug')
                ->add('title')
                ->add('created_at')
        ;
    }
    
    public function prePersist($object) {
        $this->saveFile($object);
    }

    public function preUpdate($object) {
        $this->saveFile($object);
    }
    
     public function setContainer($container){
        $this->container = $container;
    }
    
    public function saveFile($object) {
        $handler = $this->container->get('unify_image_upload');
        $handler->setSubDir('products');
        $result = $handler->upload($object->getImg());
        if($result){
            $object->setImg($handler->getPath());
        }else if($result === false){
            throw new NotFoundHttpException($handler->getError());
        }else{
            $object->setImg($object->getOldImg());
        }
    }
    
    
}

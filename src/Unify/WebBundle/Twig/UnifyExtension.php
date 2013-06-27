<?php

namespace Unify\WebBundle\Twig;

class UnifyExtension extends \Twig_Extension {

    private $container;
    private $relations;

    public function __construct($container) {
        $this->container = $container;
        $this->generator = $this->container->get('router');
    }

    public function getName() {
        return 'unify_extension';
    }

    public function getFilters() {
        return array(
            'summary' => new \Twig_Filter_Method($this, 'summaryFilter'),
        );
    }

    public function getFunctions() {
        return array(
//             'summary' => new \Twig_Function_Method($this, 'summaryFunction'),
        );
    }
    
    public function summaryFilter($string, $length = 100){
        return substr($string, 0, $length) . '...';
    }
}
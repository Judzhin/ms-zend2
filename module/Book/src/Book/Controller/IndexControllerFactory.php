<?php

namespace Book\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class IndexControllerFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $sl) {
        $ctr = new IndexController();

        $ctr->setGreetingService(// внедряется зависимость, Setter Injection
                $sl->getServiceLocator()->get('Book\Service\GreetingService')
        );
        
        return $ctr;
    }

}

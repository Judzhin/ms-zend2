<?php

namespace Book\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class GreetingServiceFactory implements FactoryInterface {
    /**
     * 
     * @param \Zend\ServiceManager\ServiceLocatorInterface $sl
     * @return \Book\Service\GreetingService
     */
    //public function createService(ServiceLocatorInterface $sl) {
    //    $gs = new GreetingService();
    //
    //    $gs->setEventManager($sl->get('eventManager'));
    //
    //    //$ls = $sl->get('Book\Service\LoggingService');
    //    // $gs->getEventManager()->attach('getGreeting', array($ls, 'onGetGreeting'));
    //
    //    $gs->getEventManager()->attach('getGreeting', function($e) use($sl) {
    //                $sl->get('Book\Service\LoggingService')->onGetGreeting($e);
    //            }
    //    );
    //
    //    return $gs;
    //}

    /**
     * 
     * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator
     * @return \Book\Service\GreetingService
     */
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $serviceLocator->get('sharedEventManager')->attach(
                'GreetingService', 'getGreeting', function($e) use($serviceLocator) {
                    $serviceLocator->get('Book\Service\LoggingService')->onGetGreeting($e);
                });

        $greetingService = new GreetingService();
        return $greetingService;
    }

}
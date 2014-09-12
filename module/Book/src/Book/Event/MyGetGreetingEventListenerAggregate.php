<?php

namespace Book\Event;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManagerInterface;

class MyGetGreetingEventListenerAggregate implements ListenerAggregateInterface {

    /**
     * 
     * @param \Zend\EventManager\EventManagerInterface $em
     */
    public function attach(EventManagerInterface $em) {
        $em->attach(
                'getGreeting', function($e) {
                    // [..]
                }
        );

        $em->attach(
                'refreshGreeting', function($e) {

                    //[..]
                }
        );
    }

    /**
     * 
     * @param \Zend\EventManager\EventManagerInterface $events
     */
    public function detach(EventManagerInterface $events) {
        // [..]
    }

}
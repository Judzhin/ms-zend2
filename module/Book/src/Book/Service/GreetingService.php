<?php

namespace Book\Service;

use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\Event;

//class GreetingService {
class GreetingService implements EventManagerAwareInterface {

    /**
     * 
     * @var \Zend\EventManager\EventManagerInterface
     */
    private $eventManager;

    /**
     * 
     * @return string
     */
    public function getGreeting() {

        //$e = new Zend\EventManager\Event();
        ////$event->setName('getGreeting');
        //$e->setName(__FUNCTION__);
        //$this->eventManager->trigger($e);
        //$this->eventManager->addIdentifiers('GreetingService');
        //$this->eventManager->setEventClass('Book\Event\GreetingEvent');
        //$this->eventManager->trigger('getGreeting');
        //$event = new \Book\Event\GreetingEvent();
        //$event->setName('getGreeting');
        //$this->eventManager->trigger($event);

        $event = new \Book\Event\MyGetGreetingEvent();
        $this->eventManager->trigger($event);

        if (date("H") <= 11) {
            return "Good morning, world!";
        } else if (date("H") > 11 && date("H") < 17) {
            return "Hello, world!";
        } else {
            return "Good evening, world!";
        }
    }

    /**
     * 
     * @return \Zend\EventManager\EventManagerInterface
     */
    public function getEventManager() {
        return $this->eventManager;
    }

    /**
     * 
     * @param \Zend\EventManager\EventManagerInterface $em
     */
    public function setEventManager(EventManagerInterface $em) {
        $this->eventManager = $em;
    }

}

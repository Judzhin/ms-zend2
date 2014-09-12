<?php

namespace Book\Event;

use Zend\EventManager\Event;

class MyGetGreetingEvent extends Event {

    private $myObject;

    public function __construct() {
        parent::__construct();
        $this->setName('getGreeting'); // предопределенное имя события
    }

    public function setMyObject($myObject) {
        $this->myObject = $myObject;
    }

    public function getMyObject() {
        return $this->myObject;
    }

}
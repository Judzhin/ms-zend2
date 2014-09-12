<?php

namespace Book\Event;

use Zend\EventManager\Event;

class GreetingEvent extends Event {

    private $myObject;

    public function setMyObject($myObject) {
        $this->myObject = $myObject;
    }

    public function getMyObject() {
        return $this->myObject;
    }

}

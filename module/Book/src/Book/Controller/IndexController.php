<?php

namespace Book\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {

    private $greetingService;

    public function indexAction() {

        //$resp = new \Zend\Http\PhpEnvironment\Response;
        //$resp->setStatusCode(503);
        //return $resp;

        return new ViewModel(array(
            'greeting' => $this->greetingService->getGreeting(),
            'date' => $this->currentDate()
        ));
    }

    // метод ("Setter") для внедрения зависимостей
    public function setGreetingService($service) {
        $this->greetingService = $service;
    }

}

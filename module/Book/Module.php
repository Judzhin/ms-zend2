<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Book;

//use Zend\Mvc\ModuleRouteListener;
//use Zend\Mvc\MvcEvent;
//use Zend\Db\ResultSet\ResultSet;
//use Zend\Db\TableGateway\TableGateway;
use Zend\EventManager\EventInterface as Event;
use Zend\ModuleManager\ModuleManager;

class Module {

    /**
     * 
     * @param \Zend\ModuleManager\ModuleManager $mm
     */
    public function init(ModuleManager $mm) {


        $events = $mm->getEventManager();
        $events->attach('loadModules.post', array($this, 'modulesLoaded'));
        //$events->attach('loadModules.post', array($this, 'onModulesPost'));
        //$se = $events->getSharedManager();
        //$se->attach('application', 'route', function($e) {
        //    die("Event '{$e->getName()}' wurde ausgeloest!");
        //});

        $sharedEvents = $events->getSharedManager();

        $sharedEvents->attach(__NAMESPACE__, 'dispatch', function($e) {
                    $ctrl = $e->getTarget();
                    $ctrl->layout('layout/testlayout');
                }, 100);
    }

    //public function onModulesPost(Event $e) {
    //    // This method is called once all modules are loaded.
    //    $moduleManager = $e->getTarget();
    //    $loadedModules = $moduleManager->getLoadedModules();
    //    // To get the configuration from another module named 'FooModule'
    //    //$config = $moduleManager->getModule('FooModule')->getConfig();
    //}

    public function modulesLoaded(Event $e) {
        // This method is called once all modules are loaded.
        $moduleManager = $e->getTarget();
        $loadedModules = $moduleManager->getLoadedModules();
        // To get the configuration from another module named 'FooModule'
        //$config = $moduleManager->getModule('FooModule')->getConfig();
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php'
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    //public function getViewHelperConfig() {
    //    return array(
    //        'invokables' => array(
    //            'displayCurrentDate' => 'Book\View\Helper\DisplayCurrentDate'
    //        )
    //    );
    //}
    //public function getServiceConfig() {
    //    return array(
    //        'factories' => array(
    //            'greetingService' => 'Book\Service\GreetingServiceFactory'
    //        ),
    //        'invokables' => array(
    //            'loggingService' => 'Book\Service\LoggingService'
    //        ),
    //    );
    //}
}

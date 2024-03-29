<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

use Application\Model\Album;
use Application\Model\AlbumTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;


class Module {

    public function onBootstrap(MvcEvent $e) {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig() {
        return array(
            'factories' => array(
                'Album\Model\AlbumTable' => function($serviceManager) {
                    $table = $serviceManager->get('AlbumTableGateway');
                    $table = new AlbumTable($table);
                    return $table;
                },
                'AlbumTableGateway' => function ($sm) {
                    $adapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $result = new ResultSet();
                    $result->setArrayObjectPrototype(new Album());
                    return new TableGateway('album', $adapter, null, $result);
                },
            ),
        );
    }

}

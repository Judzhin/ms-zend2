<?php

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'Book\Controller\Index',
                        'action' => 'index',
                    ),
                ),
            ),
            'book' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/book',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Book\Controller',
                        'controller' => 'Index',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(),
                        ),
                    ),
                ),
            )
        ),
    ),
    'service_manager' => array(
//'services' => '(службы): определение служб при помощи объектов, чьи экземпляры уже созданы.',
//'invocables' => '(вызываемые): определение служб объявлением класса, экземпляр которого будет создан при необходимости.',
//'factories' => '(фабрики): определение фабрик, которые строят экземпляр класса.',
//'abstract_factories' => '(абстрактные фабрики): определение абстрактных фабрик.',
//'aliases' => '(псевдонимы): определение псевдонимов.',
//'shared' => '(разделяемые): позволяет точно указать, может ли определенный сервис использоваться несколько раз, или должен быть создан новый экземпляр, если он снова потребуется.',
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
        // separator
        'factories' => array(
            'Book\Service\GreetingService' => 'Book\Service\GreetingServiceFactory'
        ),
        'invokables' => array(
            //'Book\Service\GreetingService' => 'Book\Service\GreetingService',
            'Book\Service\LoggingService' => 'Book\Service\LoggingService'
        )
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
//'invokables' => array(
//    'Book\Controller\Index' => 'Book\Controller\IndexController'
//),
// separator
        'factories' => array(
//'Book\Controller\Index' => 'Book\Controller\IndexControllerFactory'
            'Book\Controller\Index' => function($sl) {
                $ctr = new Book\Controller\IndexController();

                $ctr->setGreetingService(
                        $sl->getServiceLocator()->get('Book\Service\GreetingService')
                );

                return $ctr;
            }
        )
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'book/index/index' => __DIR__ . '/../view/book/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'displayCurrentDate' => 'Book\View\Helper\DisplayCurrentDate'
        )
    ),
    'console' => array(
        'router' => array(
            'routes' => array(),
        ),
    ),
);

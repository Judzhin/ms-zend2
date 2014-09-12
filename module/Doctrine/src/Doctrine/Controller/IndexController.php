<?php

namespace Doctrine\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Debug\Debug;
use Doctrine\Entity\User;

#collection
use Doctrine\Common\Collections\ArrayCollection;
use DoctrineModule\Paginator\Adapter\Collection as Adapter;
use Zend\Paginator\Paginator;

# hydrator
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;

class IndexController extends AbstractActionController {
    /**
     * 
     * @param \Zend\Mvc\MvcEvent $e
     * @return type
     */
    //public function onBootstrap(\Zend\Mvc\MvcEvent $e) {
    //public function onDispatch(\Zend\Mvc\MvcEvent $e) {
    //    echo '1';
    //    $em = $e->getApplication()->getEventManager();
    //    $em->attach(\Zend\Mvc\MvcEvent::EVENT_FINISH, array($this, 'preDispatch'));
    //    return parent::onDispatch($e);
    //}

    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    protected $_entManager;

    public function onDispatch(\Zend\Mvc\MvcEvent $e) {
        $this->_entManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        return parent::onDispatch($e);
    }

    /**
     * 
     */
    public function createAction() {
        $user = new User();
        $user->setFullName('Marco Pivetta');
        $user->setEmail('info@msbios.com');

        $this->_entManager->persist($user);
        $this->_entManager->flush();

        Debug::dump($user->getId()); //yes, I'm lazy
        die();
    }

    /**
     * 
     */
    public function collectionAction() {
        $collection = new ArrayCollection(range(1, 101));
        $paginator = new Paginator(new Adapter($collection));
        $paginator->setCurrentPageNumber(1)->setItemCountPerPage(5);
    }

    /**
     * 
     */
    public function existsAction() {

        $validator = new \DoctrineModule\Validator\ObjectExists(array(
            'object_repository' => $this->_entManager->getRepository('Doctrine\Entity\User'),
            'fields' => array('email')
        ));

        Debug::dump($validator->isValid('test@example.com'));
        Debug::dump($validator->isValid(array(
                    'email' => 'info@msbios.com'
        )));
        die();
    }

    /**
     * 
     */
    public function cacheAction() {

        //$zendCache = new \Zend\Cache\Storage\Adapter\Memory();
        //$cache = new \DoctrineModule\Cache\ZendStorageCache($zendCache);

        $doctrineCache = new \Doctrine\Common\Cache\ArrayCache();
        $options = new \Zend\Cache\Storage\Adapter\AdapterOptions();

        $cache = new \DoctrineModule\Cache\DoctrineCacheStorage(
                $options, $doctrineCache
        );

        die('stop');
    }

    /**
     * 
     */
    public function hydratorAction() {

        $hydrator = new DoctrineObject(
                $this->_entManager, 'Doctrine\Entity\User'
        );

        $user = new User();
        $data = array('fullName' => 'Judzhin Miles');

        $user = $hydrator->hydrate($data, $user);

        Debug::dump($user->getFullName()); // prints "Frankfurt"

        $dataArray = $hydrator->extract($user);
        Debug::dump($dataArray['fullName']); // prints "Frankfurt"


        die('stop');
    }

}

<?php

namespace Romanenko\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

// 2. use Romanenko\Models\Post\Mapper as PostMapper;

class BlogController extends AbstractActionController {

    public function postAction() {
        
        $postId = $this->getEvent()->getRouteMatch()->getParam('postId');
        
        $logger = new \Zend\Log\Logger();
        $logger->addWriter(new \Zend\Log\Writer\FirePhp(), \Zend\Log\Logger::INFO);
        
        // $ent = new \Romanenko\Models\Post\Mapper(); // 1. 
        // $ent = new PostMapper(); // 2.
        $ent = $this->getServiceLocator()->get('PostEntity'); // 3.
        $ent->find($postId);
        //\Zend\Debug\Debug::dump($ent);
        //die();
        
        $vm = new ViewModel(array(
            'postId' => $postId
        ));
        
        $child = new ViewModel();
        $child->setTemplate('post/widget');
        
        $vm->addChild($child, 'widget');
        
        return $vm;
    }

}

<?php

namespace Practice\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PracticeController  extends AbstractActionController{
    
    
    public function indexAction() {
        echo "working";
    }
    
    public function testAction(){
        echo "success";
    }
        
}

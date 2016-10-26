<?php

namespace Practice\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PracticeController extends AbstractActionController {

    public function indexAction() {
        echo "working";
    }

    public function testAction() {
        $id = $this->params()->fromRoute('id');
        $service = $this->getServiceLocator()->get('PracticeService');
        if(empty($id)){
            $result = $service->fetchAll();
        }else{
            $result = $service->fetchOne($id);
        }
        
//        echo $result->getArtist();
        echo "<pre>";
        print_r($result);
    }

}

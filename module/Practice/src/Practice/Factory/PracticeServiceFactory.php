<?php

namespace Practice\Factory;

use Zend\ServiceManager\FactoryInterface;

class PracticeServiceFactory implements FactoryInterface {

    public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {
        $db = $serviceLocator->get('DbAdapter');
        $gateway = new \Practice\Gateway\PracticeGateway($db);
        return new \Practice\Service\PracticeService($gateway);
    }

}

<?php

namespace Post\Factory;

use Post\Service\PostService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Post\Mapper\ZendDbSqlMapper;
use Post\Model\Post;
use Zend\Stdlib\Hydrator\ClassMethods;


class PostServiceFactory implements FactoryInterface {

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        $db = new ZendDbSqlMapper(
                $realServiceLocator->get('Zend\Db\Adapter\Adapter'), new ClassMethods(false), new Post()
        );
        $a = new PostService($db);        
        return $a;
    }

}

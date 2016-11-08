<?php

namespace Post\Factory;

use Post\Mapper\ZendDbSqlMapper;
use Post\Model\Post;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\ClassMethods;

class ZendDbSqlMapperFactory implements FactoryInterface {

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        $db = new ZendDbSqlMapper(
                $realServiceLocator->get('Zend\Db\Adapter\Adapter'), new ClassMethods(false), new Post()
        );
        return $db;
    }

}

<?php

namespace Post\Factory;

use Post\Controller\PostListController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Post\Mapper\ZendDbSqlMapper;
use Post\Model\Post;
use Zend\Stdlib\Hydrator\ClassMethods;
use Post\Service\PostService;

class ListControllerFactory implements FactoryInterface {

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        $adapter = new ZendDbSqlMapper(
                $realServiceLocator->get('Zend\Db\Adapter\Adapter'), new ClassMethods(false), new Post()
        );
        $postService = new PostService($adapter);

        return new PostListController($postService);
    }

}

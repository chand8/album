<?php

namespace Post;

return array(
    'db' => array(
        'driver' => 'Pdo',
        'username' => 'root', //edit this
        'password' => 'chand', //edit this
        'dsn' => 'mysql:dbname=blog;host=localhost',
        'driver_options' => array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        )
    ),
    'controllers' => array(
        'invokables' => array(
        ),
        'factories' => array(
            'Post\Mapper\PostMapperInterface'   => 'Post\Factory\ZendDbSqlMapperFactory',
            'Post\Controller\PostList' => 'Post\Factory\ListControllerFactory',
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
            'Post\Service\PostServiceInterface' => 'Post\Factory\PostServiceFactory'
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'service_manager' => array(
        'invokables' => array(
        )
    ),
    // This lines opens the configuration for the RouteManager
    'router' => array(
        // Open configuration for all possible routes
        'routes' => array(
            // Define a new route called "post"
            'post' => array(
                // Define the routes type to be "Zend\Mvc\Router\Http\Literal", which is basically just a string
                'type' => 'segment',
                // Configure the route itself
                'options' => array(
                    // Listen to "/blog" as uri
                    'route' => '/post[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    // Define default controller and action to be called when this route is matched
                    'defaults' => array(
                        'controller' => 'Post\Controller\PostList',
                        'action' => 'index',
                    )
                )
            )
        )
    )
);

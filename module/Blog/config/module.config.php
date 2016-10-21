<?php

// Filename: /module/Blog/config/module.config.php
return array(
    'controllers' => array(
        'factories' => array(
            'Blog\Controller\List' => 'Blog\Factory\ListControllerFactory'
        )
    ),
    'service_manager' => array(
        'invokables' => array(
            'Blog\Service\PostServiceInterface' => 'Blog\Service\PostService'
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'router' => array(
        'routes' => array(
            'post' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/blog[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Blog\Controller\List',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
        // This lines opens the configuration for the RouteManager
//     'router' => array(
//         // Open configuration for all possible routes
//         'routes' => array(
//             // Define a new route called "post"
//             'blog' => array(
//                 // Define the routes type to be "Zend\Mvc\Router\Http\Literal", which is basically just a string
//                 'type' => 'literal',
//                 // Configure the route itself
//                 'options' => array(
//                     // Listen to "/blog" as uri
//                     'route'    => '/blog',
//                     // Define default controller and action to be called when this route is matched
//                     'defaults' => array(
//                         'controller' => 'Blog\Controller\List',
//                         'action'     => 'index',
//                     )
//                 )
//             )
//         )
//     )
);


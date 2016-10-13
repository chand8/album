<?php

namespace Practice;

return array(
    'router' => array(
        'routes' => array(
            'practice' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/practice[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Practice\Controller\Practice',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Practice\Controller\Practice' => 'Practice\Controller\PracticeController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'practice' => __DIR__ . '/../view',
        ),
    ),
);

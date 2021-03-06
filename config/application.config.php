<?php

return array(
    'modules' => array(
        'Application',
        'Album',
        'AlbumRest',
        'Practice',
        'Blog'
    ),
    'module_listener_options' => array(
        'config_glob_paths'    => array(
            'config/autoload/{,*.}{global,local}.php',
        ),
        'module_paths' => array(
            './module',
            './vendor',
        'Api' => './vendor/coderockr/api'
        ),
    ),
    'cache' => array(
        'adapter' => 'memory'
    ),
);

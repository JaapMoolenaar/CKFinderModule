<?php

return array(
    'router' => array(
        'routes' => array(
            'ckfinder' => array(
                'type' => 'literal',
                'options' => array(
                    'route'    => '/ckfinder/core/connector/php/connector.php',
                    'defaults' => array(
                        'controller' => 'CKFinderModule\Controller\Connector',
                        'action'     => 'index',
                    ),
                )

            ),

        ),
    ),

    'service_manager' => array(
        'factories' => array(
            'CKFinderModule\Config' => 'CKFinderModule\Service\ConfigServiceFactory',
        ),
    ),

    'controllers' => array(
        'invokables' => array(
            'CKFinderModule\Controller\Connector' => 'CKFinderModule\Controller\ConnectorController'
        ),
    ),

    'ckfinder_module' => array(
        'ckfinder_vendor_path'  => './vendor/ckfinder/ckfinder/',
        'ckfinder_config_path'  => __DIR__ . '/ckfinder.config.php',
        'ckfinder_basepath'     => '/ckfinder/', // should be the same as the folder made accessible with the assetmanager
    ),
);

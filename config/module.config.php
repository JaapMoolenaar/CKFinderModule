<?php

return array(
    'router' => array(
        'routes' => array(

            'ckfinder' => array(
                'type' => 'literal',
                'options' => array(
                    'route'    => '/ckfinder',
                    'defaults' => array(
                        'controller' => 'CKFinderModule\Controller\Browse',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,

                'child_routes' => array(
                    'connector' => array(
                        'type'    => 'literal',
                        'options' => array(
                            'route'    => '/core/connector/php/connector.php',
                            'defaults' => array(
                                'controller' => 'CKFinderModule\Controller\Connector',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                ),

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
            'CKFinderModule\Controller\Browse' => 'CKFinderModule\Controller\BrowseController',
            'CKFinderModule\Controller\Connector' => 'CKFinderModule\Controller\ConnectorController'
        ),
    ),

    /**
     * Default BjyAuthorize configuration for ACL
     */
    'bjyauthorize' => array(
        'guards' => array(
            'BjyAuthorize\Guard\Route' => array(
                array('route' => 'ckfinder', 'roles' => array('admin')),
                array('route' => 'ckfinder/connector', 'roles' => array('admin')),
            ),
        ),
    ),

    /**
     * Default ZfcRbac configuration for RBAC
     */
    'zfcrbac' => array(
        'firewall_route' => true,
        'firewalls' => array(
            'ZfcRbac\Firewall\Route' => array(
                'zfcadmin' => array('route' => '^ckfinder/*', 'roles' => 'admin')
            )
        ),
    ),

    'ckfinder_module' => array(
        'ckfinder_vendor_path'  => './vendor/ckfinder/ckfinder/',
        'ckfinder_config_path'  => __DIR__ . '/ckfinder.config.php',
        'ckfinder_basepath'     => '/ckfinder/', // should be the same as the folder made aaccessible with the assetmanager
        'ckfinder_width'        => '100%',
        'ckfinder_height'       => '100%',
    ),

    'asset_manager' => array(
        'resolver_configs' => array(
            'paths' => array(
                realpath('./vendor/ckfinder/'), // this way example.com/ckfinder is accessible
            ),
        ),
    ),
);

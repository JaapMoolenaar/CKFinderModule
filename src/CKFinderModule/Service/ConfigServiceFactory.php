<?php
namespace CKFinderModule\Service;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

class ConfigServiceFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');

        return array_key_exists('ckfinder_module', $config) ? $config['ckfinder_module'] : array();
    }
}

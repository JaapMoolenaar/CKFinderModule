<?php
namespace CKFinderModule\Controller;

use \Zend\Mvc\Controller\AbstractActionController;

class ConnectorController extends AbstractActionController
{
    public function indexAction()
    {
        $config = $this->getServiceLocator()->get('CKFinderModule\Config');

        require_once realpath($config['ckfinder_vendor_path']) . '/core/connector/php/vendor/autoload.php';

        $ckfinder = new \CKSource\CKFinder\CKFinder($config['ckfinder_config_path']);

        $ckfinder->run();

        return $this->response;
    }
}

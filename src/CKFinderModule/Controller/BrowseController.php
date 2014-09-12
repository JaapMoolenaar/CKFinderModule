<?php

namespace CKFinderModule\Controller;

use \Zend\Mvc\Controller\AbstractActionController;

class BrowseController extends AbstractActionController
{

    public function indexAction()
    {
        $config = $this->getServiceLocator()->get('CKFinderModule\Config');

        $ckFinderPath = realpath($config['ckfinder_vendor_path']) . '/';

        if (!file_exists($ckFinderPath . 'ckfinder.php')) {
            throw new \Exception('The ckfinder path "' . $ckFinderPath . '" does not seem to be valid');
        }

        // Otherwise, we're going to need the CKFinder class
        require_once $ckFinderPath . 'ckfinder.php';

        // You can use the "CKFinder" class to render CKFinder in a page:
        $finder = new \CKFinder();
        
        // The path for the installation of CKFinder (default = "/ckfinder/").
        $finder->BasePath = $config['ckfinder_basepath'];
        $finder->Width = $config['ckfinder_width'];
        $finder->Height = $config['ckfinder_height'];
        $finder->Create();

        return $this->response;
    }
}

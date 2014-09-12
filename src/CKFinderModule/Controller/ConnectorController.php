<?php
namespace CKFinderModule\Controller;

use \Zend\Mvc\Controller\AbstractActionController;

class ConnectorController extends AbstractActionController
{
    public function indexAction()
    {
        $config = $this->getServiceLocator()->get('CKFinderModule\Config');

        $ckFinderPath = realpath($config['ckfinder_vendor_path']).'/';
        $ckFinderConnectorPath = $ckFinderPath.'core/connector/php/';
        $ckFinderConfigPath = realpath($config['ckfinder_config_path']);


        // Below is basically a copy from connector.php:

        /**
         * Protect against sending content before all HTTP headers are sent (#186).
         */
        ob_start();

        /**
         * define required constants
         */
        require_once $ckFinderConnectorPath . '/constants.php';

        // @ob_end_clean();
        // header("Content-Encoding: none");

        /**
         * we need this class in each call
         */
        require_once CKFINDER_CONNECTOR_LIB_DIR . '/CommandHandler/CommandHandlerBase.php';
        /**
         * singleton factory
         */
        require_once CKFINDER_CONNECTOR_LIB_DIR . '/Core/Factory.php';
        /**
         * utils class
         */
        require_once CKFINDER_CONNECTOR_LIB_DIR . '/Utils/Misc.php';
        /**
         * hooks class
         */
        require_once CKFINDER_CONNECTOR_LIB_DIR . '/Core/Hooks.php';

        $utilsSecurity =& \CKFinder_Connector_Core_Factory::getInstance("Utils_Security");
        $utilsSecurity->getRidOfMagicQuotes();

        /**
         * $config must be initialised
         */
        $config = array();
        $config['Hooks'] = array();
        $config['Plugins'] = array();

        /**
         * Fix cookies bug in Flash.
         */
        if (!empty($_GET['command']) && $_GET['command'] == 'FileUpload' && !empty($_POST)) {
            foreach ($_POST as $key => $val) {
                if (strpos($key, "ckfcookie_") === 0) {
                    $_COOKIE[str_replace("ckfcookie_", "", $key)] = $val;
                }
            }
        }

        /**
         * read config file
         */
        require_once $ckFinderConfigPath;

        \CKFinder_Connector_Core_Factory::initFactory();
        $connector =& \CKFinder_Connector_Core_Factory::getInstance("Core_Connector");

        // The globals array is being used for the config and connector
        // ( and $GLOBALS['CKFLang'], which is set by ckfinder itself )
        // we are however not in a global context right now, so we're going to
        // have to add the keys/references manually
        $GLOBALS['config'] =& $config;
        $GLOBALS['connector'] =& $connector;

        // Now that the config is setup like it would be in a normal ckfinder run:
        if (isset($_GET['command'])) {
            $connector->executeCommand($_GET['command']);
        } else {
            $connector->handleInvalidCommand();
        }

        // Please do not render view / layout!
        return $this->response;
    }
}

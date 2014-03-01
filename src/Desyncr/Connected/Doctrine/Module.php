<?php
/**
 * Desyncr\Connected\Doctrine
 *
 * PHP version 5.4
 *
 * @category General
 * @package  Desyncr\Connected\Doctrine
 * @author   Dario Cavuotti <dc@syncr.com.ar>
 * @license  http://gpl.gnu.org GPL-3.0+
 * @version  GIT:<>
 * @link     https://github.com/desyncr
 */
namespace Desyncr\Connected\Doctrine;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\Mvc\MvcEvent;

/**
 * Class Module
 *
 * @category General
 * @package  Desyncr\Connected\Doctrine
 * @author   Dario Cavuotti <dc@syncr.com.ar>
 * @license  https://www.gnu.org/licenses/gpl.html GPL-3.0+
 * @link     https://docs.saludmovil.net
 */
class Module implements
    AutoloaderProviderInterface,
    ConfigProviderInterface,
    ServiceProviderInterface
{
    /**
     * getAutoloaderConfig
     *
     *
     * @return mixed
     */
    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespace' => array(__NAMESPACE__ => __DIR__)
            )
        );
    }

    /**
     * getConfig
     *
     * @return mixed
     */
    public function getConfig() {
        return include __DIR__ . '/../../../../config/module.config.php';
    }


    /**
     * getServiceConfig
     *
     * @return mixed
     */
    public function getServiceConfig() {
        return include __DIR__ . '/../../../../config/connected-doctrine.local.php';
    }
}

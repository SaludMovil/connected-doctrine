<?php

/**
 * General class.
 *
 * PHP version 5.4
 *
 * @category General
 * @package  CoreTest\Desyncr\Connected\DoctrineTest
 * @author   Dario Cavuotti <dc@syncr.com.ar>
 * @license  https://www.gnu.org/licenses/gpl.html GPL-3.0+
 * @version  GIT:<>
 * @link     https://github.com/desyncr
 */
namespace Desyncr\Connected\DoctrineTest\Base;

use Bootstrap;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class TestBase
 *
 * @category General
 * @package  CoreTest\Desyncr\Connected\DoctrineTest
 * @author   Dario Cavuotti <dc@syncr.com.ar>
 * @license  https://www.gnu.org/licenses/gpl.html GPL-3.0+
 * @link     https://github.com/desyncr
 */
class TestBase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ServiceLocatorInterface
     */
    protected $sm;

    /**
     * setUp
     *
     * @return mixed
     */
    protected function setUp()
    {
        $this->setServiceManager($this->getServiceManager());
    }

    /**
     * setServiceManager
     *
     * @param ServiceLocatorInterface $sm Service Manager
     *
     * @return mixed
     */
    protected function setServiceManager(ServiceLocatorInterface $sm)
    {
        $this->sm = $sm;
    }

    /**
     * getServiceManager
     *
     * @return ServiceLocatorInterface
     */
    protected function getServiceManager()
    {
        return $this->sm ?:
            $this->sm = Bootstrap::getServiceManager();
    }
}

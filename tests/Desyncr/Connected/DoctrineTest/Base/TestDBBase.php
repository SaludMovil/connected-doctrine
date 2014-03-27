<?php
/**
 * CoreTest\Base
 *
 * PHP version 5.4
 *
 * @category General
 * @package  CoreTest\Base
 * @author   Dario Cavuotti <dc@syncr.com.ar>
 * @license  https://www.gnu.org/licenses/gpl.html GPL-3.0+
 * @version  GIT:<>
 * @link     https://github.com/desyncr
 */
namespace Desyncr\Connected\DoctrineTest\Base;

use Bootstrap;
use Zend\ServiceManager\ServiceLocatorInterface;
use Doctrine\ORM\Tools\SchemaTool;

/**
 * Class TestBase
 *
 * @category General
 * @package  CoreTest\Worker\Base
 * @author   Dario Cavuotti <dc@syncr.com.ar>
 * @license  https://www.gnu.org/licenses/gpl.html GPL-3.0+
 * @link     https://github.com/desyncr
 */
class TestDBBase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ServiceLocatorInterface
     */
    protected $sm;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * setUp
     *
     * @return mixed
     */
    protected function setUp()
    {
        $this->setServiceManager($this->getServiceManager());
        $this->getConnection();
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

    /**
     * getEntityManager
     *
     * @return \Doctrine\ORM\EntityManager
     */
    protected function getEntityManager()
    {
        return $this->em ?: $this->em
            = $this->getServiceManager()->get('Doctrine\ORM\EntityManager');
    }

    /**
     * setEntityManager
     *
     * @param $em
     *
     * @return mixed
     */
    protected function setEntityManager($em)
    {
        $this->em = $em;
    }

    /**
     * getConnection
     *
     * @return mixed
     */
    public function getConnection()
    {
        // Get an instance of your entity manager
        $entityManager = $this->getEntityManager();

        // Retrieve PDO instance
        $pdo = $entityManager->getConnection()->getWrappedConnection();

        // Clear Doctrine to be safe
        $entityManager->clear();

        // Schema Tool to process our entities
        $tool = new SchemaTool($entityManager);
        $classes = $entityManager->getMetaDataFactory()->getAllMetaData();

        // Drop all classes and re-build them for each test case
        $tool->dropSchema($classes);
        $tool->createSchema($classes);

    }
}


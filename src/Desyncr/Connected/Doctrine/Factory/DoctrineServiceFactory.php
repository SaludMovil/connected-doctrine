<?php
/**
 * Desyncr\Connected\Doctrine\Factory
 *
 * PHP version 5.4
 *
 * @category General
 * @package  Desyncr\Connected\Doctrine\Factory
 * @author   Dario Cavuotti <dc@syncr.com.ar>
 * @license  http://gpl.gnu.org GPL-3.0+
 * @version  GIT:<>
 * @link     https://github.com/desyncr
 */
namespace Desyncr\Connected\Doctrine\Factory;

use Desyncr\Connected\Factory\AbstractServiceFactory;
use Desyncr\Connected\Doctrine\Service\DoctrineService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class DoctrineServiceFactory
 *
 * @category General
 * @package  Desyncr\Connected\Doctrine\Factory
 * @author   Dario Cavuotti <dc@syncr.com.ar>
 * @license  https://www.gnu.org/licenses/gpl.html GPL-3.0+
 * @link     https://github.com/desyncr
 */
class DoctrineServiceFactory extends AbstractServiceFactory implements
    FactoryInterface
{
    /**
     * createService
     *
     * @param ServiceLocatorInterface $serviceLocator Service Manager
     *
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $service = new DoctrineService();
        $service->setEntityManager(
            $serviceLocator->get('Doctrine\ORM\EntityManager')
        );
        $service->setServiceLocator($serviceLocator);

        return $service;
    }
}

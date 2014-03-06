<?php
/**
 * Desyncr\Connected\Doctrine\Factory
 *
 * PHP version 5.4
 *
 * @category General
 * @package  Desyncr\Connected\Doctrine\Factory
 * @author   Dario Cavuotti <dc@syncr.com.ar>
 * @license  https://www.gnu.org/licenses/gpl.html GPL-3.0+
 * @version  GIT:<>
 * @link     https://github.com/desyncr
 */
namespace Desyncr\Connected\Doctrine\Factory;

use Desyncr\Connected\Factory\AbstractServiceFactory;
use Desyncr\Connected\Doctrine\Service\DoctrineService;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Desyncr\Connected\Doctrine\Factory
 *
 * @category General
 * @package  Desyncr\Connected\Doctrine\Factory
 * @author   Dario Cavuotti <dc@syncr.com.ar>
 * @license  https://www.gnu.org/licenses/gpl.html GPL-3.0+
 * @link     https://docs.saludmovil.net
 */
class DoctrineServiceFactory extends AbstractServiceFactory
{
    /**
     * @var string
     */
    protected $configuration_key = 'doctrine-adapter';

    /**
     * createService
     *
     * @param ServiceLocatorInterface $serviceLocator Service Manager
     *
     * @return DoctrineService
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        parent::createService($serviceLocator);
        $service = new DoctrineService();
        $service->setOptions(
            array('em' => $serviceLocator->get('Doctrine\ORM\EntityManager'))
        );

        $service->setEntity($this->getConfig('entity'));
        $service->setEntityTarget($this->getConfig('target'));
        $service->setServiceLocator($serviceLocator);

        return $service;
    }
}

<?php
namespace Desyncr\Connected\Doctrine\Factory;
use Desyncr\Connected\Factory as Connected;
use Desyncr\Connected\Doctrine\Service\DoctrineService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DoctrineServiceFactory extends Connected\AbstractServiceFactory implements FactoryInterface {
    protected $configuration_key = 'doctrine-adapter';

    public function createService(ServiceLocatorInterface $serviceLocator) {
        parent::createService($serviceLocator);
    }
}

<?php
/**
 * Desyncr\Connected\Doctrine\Service
 *
 * PHP version 5.4
 *
 * @category General
 * @package  Desyncr\Connected\Doctrine\Service
 * @author   Dario Cavuotti <dc@syncr.com.ar>
 * @license  http://gpl.gnu.org GPL-3.0+
 * @version  GIT:<>
 * @link     https://github.com/desyncr
 */
namespace Desyncr\Connected\Doctrine\Service;

use Desyncr\Connected\Doctrine\Entity;
use Desyncr\Connected\Service\AbstractService;
use Doctrine\ORM\EntityManagerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class DoctrineService
 *
 * @category General
 * @package  Desyncr\Connected\Doctrine\Service
 * @author   Dario Cavuotti <dc@syncr.com.ar>
 * @license  https://www.gnu.org/licenses/gpl.html GPL-3.0+
 * @link     https://github.com/desyncr
 */
class DoctrineService extends AbstractService
{
    /**
     * @var
     */
    protected $sm;

    /**
     * @var
     */
    protected $em;

    /**
     * dispatch
     *
     * @return mixed
     */
    public function dispatch()
    {
        $em = $this->getEntityManager();
        foreach ($this->frames as $frame) {
            $em->persist($frame);
        }
        $em->flush();
        $em->clear();
        $this->frames = array();
    }

    /**
     * add
     *
     * @param String                 $id    Notification ID
     * @param Entity\EntityInterface $frame Notification object
     *
     * @return mixed
     */
    public function add($id, $frame)
    {
        /** @var Object $frame */
        return parent::add($id, $frame);
    }

    /**
     * setServiceLocator
     *
     * @param ServiceLocatorInterface $sm Service Manager
     *
     * @return mixed
     */
    public function setServiceLocator(ServiceLocatorInterface $sm)
    {
        $this->sm = $sm;
    }

    /**
     * getServiceLocator
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->sm;
    }

    /**
     * getEntityManager
     *
     * @return EntityManagerInterface
     */
    public function getEntityManager()
    {
        return $this->em ?: $this->em
            = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
    }

    /**
     * setEntityManager
     *
     * @param EntityManagerInterface $em Entity manager
     *
     * @return Object
     */
    public function setEntityManager(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
}

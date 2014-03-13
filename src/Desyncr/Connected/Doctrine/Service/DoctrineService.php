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
     * @var string
     */
    protected $entityName = '';

    /**
     * @var string
     */
    protected $entityTargetName = '';

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
        foreach ($this->frames as $frame) {
            $notification = $this->createEntity($this->getEntity(), $frame, false);

            // pre dispatch
            $targets = $this->getTargets($frame);
            $target  = $frame->getTarget();
            $this->addTargets($notification, $target->getEntity(), $target->getClass(), $targets);

            $this->getEntityManager()->persist($notification);
            $this->getEntityManager()->flush();
            $this->getEntityManager()->clear();
        }
        $this->frames = array();
    }

    /**
     * createEntity
     *
     * @param      $entityName
     * @param null $data
     * @param bool $persist
     *
     * @return mixed
     */
    protected function createEntity($entityName, $data = null, $persist = true)
    {
        $entity = new $entityName();
        if ($data) {
            $entity = $this->initialize($entity, $data, $persist);
        }

        return $entity;
    }

    /**
     * initialize
     *
     * @param $entity
     * @param $data
     * @param $persist
     *
     * @return mixed
     */
    protected function initialize($entity, $data, $persist)
    {
        if (in_array('Desyncr\Connected\Doctrine\Entity\TargetInterface', class_implements($entity))) {
            $entity = $this->initializeTargetEntity($entity, $data);
        } else {
            $entity = $this->initializeEntity($entity, $data);
        }

        if ($persist) {
            $this->getEntityManager()->persist($entity);
            $this->getEntityManager()->flush();
        }

        return $entity;
    }

    /**
     * initializeTargetEntity
     *
     * @param $target
     * @param $data
     *
     * @return mixed
     */
    protected function initializeTargetEntity($target, $data)
    {
        $target->setTargetId($data['target_id']);
        $target->setTargetEntity($data['target_entity']);
        $target->setClass($data['class']);
        $target->setStatus($data['status']);

        return $target;
    }

    /**
     * initializeEntity
     *
     * @param $n
     * @param $frame
     *
     * @return mixed
     */
    protected function initializeEntity($n, $frame)
    {
        $n->setTitle($frame->getTitle());

        if ($text = $frame->getText()) {
            $n->setText($text);
        }

        if ($mode = $frame->getMode()) {
            $n->setMode($mode);
        }

        if ($type = $frame->getType()) {
            $n->setType($type);
        }

        if ($origin = $frame->getOrigin()) {
            $n->setOrigin($origin);
        }

        if ($scheduled = $frame->getScheduled()) {
            $n->setScheduled($scheduled);
        }

        return $n;
    }

    /**
     * getEntity
     *
     * @return mixed
     */
    public function getEntity()
    {
        return $this->entityName;
    }

    /**
     * getTargets
     *
     * @param $frame
     *
     * @return mixed
     */
    private function getTargets($frame)
    {
        $sender     = $this->getSender($frame);
        $targets    = $this->instantiateTarget($frame);
        $arrTargets = array();
        foreach ($targets as $target) {
            if ($sender == $target->getId()) {
                continue;
            };
            $arrTargets[] = $target->getId();
        }

        return $arrTargets;
    }

    /**
     * getSender
     *
     * @param $frame
     *
     * @return mixed
     */
    private function getSender($frame)
    {
        return $frame->getSender();
    }

    /**
     * instantiateTarget
     *
     * @param $frame
     *
     * @return mixed
     */
    private function instantiateTarget($frame)
    {
        $targetClass = $frame->getTarget();
        $targetClass->setServiceManager($this->getServiceLocator());
        return $targetClass->getTargets();
    }

    /**
     * addTargets
     *
     * @param $n
     * @param $entity
     * @param $targets
     *
     * @return mixed
     */
    public function addTargets($n, $entity, $class, $targets)
    {
        foreach ($targets as $targets_id) {
            $target = $this->createEntity(
                $this->getEntityTarget(),
                array(
                    'status'        => 0,
                    'target_entity' => $entity,
                    'class'         => $class,
                    'target_id'     => $targets_id
                ),
                false
            );

            $n->addTarget($target);
        }

        return $n;
    }

    /**
     * getEntityTarget
     *
     * @return mixed
     */
    public function getEntityTarget()
    {
        return $this->entityTargetName;
    }

    /**
     * setServiceLocator
     *
     * @param $sm
     *
     * @return mixed
     */
    public function setServiceLocator($sm)
    {
        $this->sm = $sm;
    }

    /**
     * getServiceLocator
     *
     * @return mixed
     */
    public function getServiceLocator()
    {
        return $this->sm;
    }

    /**
     * setEntity
     *
     * @param $entityName
     *
     * @return mixed
     */
    public function setEntity($entityName)
    {
        $this->entityName = $entityName;
    }

    /**
     * setEntityTarget
     *
     * @param $entityTargetName
     *
     * @return mixed
     */
    public function setEntityTarget($entityTargetName)
    {
        $this->entityTargetName = $entityTargetName;
    }

    /**
     * getEntityManager
     *
     * @return Object
     */
    protected function getEntityManager()
    {
        return $this->em ?:
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
    }

    /**
     * setEntityManager
     *
     * @param Object $em Entity manager
     *
     * @return Object
     */
    protected function setEntityManager($em)
    {
        $this->em = $em;
    }
}

<?php
namespace Desyncr\Connected\Doctrine\Service;
use Desyncr\Connected\Service as Connected;
use Desyncr\Connected\Doctrine\Entity;

class DoctrineService extends Connected\AbstractService {
    protected $entityName       = '';
    protected $entityTargetName = '';

    public function dispatch() {
        foreach ($this->frames as $frame) {
            $notification = $this->createEntity($this->getEntity(), $frame, false);

            $targets = $frame->get('target');
            if (!is_array($targets)) {
                $targets = array($targets);
            }
            $this->addTargets($notification, $targets);

            $this->em->persist($notification);
            $this->em->flush();
        }
    }

    protected function createEntity($entityName, $data = null, $persist = true) {
        $entity = new $entityName();
        if ($data) {
            $entity = $this->initialize($entity, $data, $persist);
        }
        return $entity;
    }

    protected function initialize($entity, $data, $persist) {
        if (in_array('Desyncr\Connected\Doctrine\Entity\TargetInterface', class_implements($entity))) {
            $entity = $this->initializeTargetEntity($entity, $data);
        } else {
            $entity = $this->initializeEntity($entity, $data);
        }

        if ($persist) {
            $this->em->persist($entity);
            $this->em->flush();
        }
        return $entity;
    }

    protected function initializeTargetEntity($target, $data) {
        $target->setTarget($data['target']);
        $target->setStatus($data['status']);
        return $target;
    }

    protected function initializeEntity($n, $frame) {
        $n->setTitle($frame->get('title'));

        if ($text = $frame->get('text')) {
            $n->setText($text);
        }

        if ($type = $frame->get('type')) {
            $n->setType($type);
        }

        return $n;
    }

    public function addTargets($n, $targets) {
        foreach ($targets as $target) {
            $target = $this->createEntity($this->getEntityTarget(), array(
                'status' => 'unread',
                'target' => $target
            ), false);

            $n->addTarget($target);
        }

        return $n;
    }

    public function getEntity() {
        return $this->entityName;
    }
    public function setEntity($entityName) {
        $this->entityName = $entityName;
    }

    public function getEntityTarget() {
        return $this->entityTargetName;
    }

    public function setEntityTarget($entityTargetName) {
        $this->entityTargetName = $entityTargetName;
    }
}

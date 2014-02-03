<?php
namespace Desyncr\Connected\Doctrine\Service;
use Desyncr\Connected\Service\AbstractSErvice;
use Desyncr\Connected\Doctrine\Entity;

class DoctrineService extends AbstractService {
    protected $entityName       = '';
    protected $entityTargetName = '';

    public function dispatch() {
        foreach ($this->frames as $frame) {
            $notification = $this->createEntity($this->getEntity(), $frame, false);

            // pre dispatch
            $targets = $this->getTargets($frame);
            $target = $frame->get('target');
            $this->addTargets($notification, $target['entity'], $targets);

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
        $target->setTargetId($data['target_id']);
        $target->setTargetEntity($data['target_entity']);
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

        if ($origin = $frame->get('origin')) {
            $n->setOrigin($origin);
        }

        return $n;
    }

    public function addTargets($n, $entity, $targets) {
        foreach ($targets as $targets_id) {
            $target = $this->createEntity($this->getEntityTarget(), array(
                    'status' => 0,
                    'target_entity' => $entity,
                    'target_id' => $targets_id

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

    private function getTargets($frame) {
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

    private function instantiateTarget($frame) {
        $targetClass = $frame->get('target');
        $target = new $targetClass['class']($this->sm, $targetClass['targets']);
        return $target->getTargets();
    }

    private function getSender($frame) {
        $sender = $frame->get('sender');
        return $sender;
    }

    public function setServiceLocator($sm) {
        $this->sm = $sm;
    }
}

<?php
namespace Desyncr\Connected\Doctrine\Service;
use Desyncr\Connected\Service as Connected;

class DoctrineService extends Connected\AbstractService {
    public function dispatch() {

        $notification = new \Desyncr\Connected\Doctrine\Entity\Notification();
        foreach ($this->frames as $frame) {
            $notification->setBody(isset($frame['body']) ? $frame['body'] : '');
            $notification->setType(isset($frame['type']) ? $frame['type'] : 'info' );
        }

        $this->em->persist($notification);
        $this->em->flush();
    }

}

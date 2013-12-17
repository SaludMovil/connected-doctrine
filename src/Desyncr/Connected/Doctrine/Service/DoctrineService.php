<?php
namespace Desyncr\Connected\Doctrine\Service;
use Desyncr\Connected\Service as Connected;
use Desyncr\Connected\Doctrine\Entity;

class DoctrineService extends Connected\AbstractService {
    public function dispatch() {

        foreach ($this->frames as $frame) {
            $notification = new Notification();
            $notification->setBody($frame->get('title'));
            if ($type = $frame->get('type')) {
                $notification->setType($type);
            }
            $this->em->persist($notification);
        }

        $this->em->flush();
    }

}

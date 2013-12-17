<?php
namespace Desyncr\Connected\Doctrine\Service;
use Desyncr\Connected\Service as Connected;

class DoctrineService extends Connected\AbstractService {
    public function dispatch() {

        $notification = new \Desyncr\Connected\Doctrine\Entity\Notification();
        foreach ($this->frames as $frame) {
            $notification->setBody($frame->get('title'));
            if ($type = $frame->get('type')) {
                $notification->setType($type);
            }
        }

        $this->em->persist($notification);
        $this->em->flush();
    }

}

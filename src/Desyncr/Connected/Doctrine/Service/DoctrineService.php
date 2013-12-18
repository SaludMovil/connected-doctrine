<?php
namespace Desyncr\Connected\Doctrine\Service;
use Desyncr\Connected\Service as Connected;
use Desyncr\Connected\Doctrine\Entity;

class DoctrineService extends Connected\AbstractService {
    public function dispatch() {

        foreach ($this->frames as $frame) {
            $notification = new \Desyncr\Connected\Doctrine\Entity\Notification();
            $notification->setTitle($frame->get('title'));

            if ($text = $frame->get('text')) {
                $notification->setText($text);
            }

            if ($type = $frame->get('type')) {
                $notification->setType($type);
            }

            if ($target = $frame->get('target')) {
                $notification->setTarget($target);
            }

            $this->em->persist($notification);
            $this->em->flush();

            $nstatus = new \Desyncr\Connected\Doctrine\Entity\NotificationStatus();

            $nstatus->setNotification($notification->getId());
            $nstatus->setStatus('unread');
            $nstatus->setTarget($target);

            $this->em->persist($nstatus);
            $this->em->flush();
        }

        $this->em->flush();
    }

}

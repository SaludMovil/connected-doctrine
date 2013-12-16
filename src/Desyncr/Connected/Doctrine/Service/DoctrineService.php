<?php
namespace Desyncr\Connected\Doctrine\Service;
use Desyncr\Connected\Service as Connected;

class DoctrineService extends Connected\AbstractService {
    protected $em = null;

    public function __construct($em) {
        $this->em = $em;
    }

    public function dispatch() {

        $notification = new \Desyncr\Connected\Doctrine\Entity\Notification();
        $notification->setBody('Service fucked up');

        $this->em->persist($notification);
        $this->em->flush();
    }

}

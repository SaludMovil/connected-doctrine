<?php
namespace Desyncr\Connected\Doctrine\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\Criteria;

class NotificationStatusRepository extends EntityRepository
{
    public function updateByIdAndUser($nid, $user, $status) {

        if (!$nstatus = $this->findByNotificationStatus($nid, $user)) {
            $nstatus = new \Desyncr\Connected\Doctrine\Entity\NotificationStatus();
            $nstatus->setNotification($nid);
            $nstatus->setTarget($user->getId());
        }

        $this->updateNotificationStatus($nstatus, $status);
    }

    public function findByNotificationStatus($nid, $user) {

        $criteria = new Criteria();
        $criteria->andWhere(Criteria::expr()->eq("notification", $nid));
        $criteria->andWhere(Criteria::expr()->eq("target", $user->getId()));
        $res = $this->matching($criteria);

        if (count($res[0])) {
            return $res[0];
        }

        return false;
    }

    public function updateNotificationStatus($notificationStatus, $status) {
        $notificationStatus->setStatus($status);
        $this->getEntityManager()->persist($notificationStatus);
        $this->getEntityManager()->flush();
    }
}

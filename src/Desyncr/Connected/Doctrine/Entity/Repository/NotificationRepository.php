<?php
namespace Desyncr\Connected\Doctrine\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\Criteria;

class NotificationRepository extends EntityRepository
{
    public function findAllByUserAndStatus($user, $status) {
        return $this->findAllNotification(null, $user, $status);
    }

    public function findAllByUser($user) {
        return $this->findAllNotification(null, $user);
    }

    public function findAllById($nid) {
        return $this->findAllNotification($nid);
    }

    private function findAllNotification($nid = null, $user = null, $status = null) {

        $qb = $this->createQueryBuilder('n');
        $qb->leftJoin('Desyncr\Connected\Doctrine\Entity\NotificationStatus', 'ns', \Doctrine\ORM\Query\Expr\Join::WITH, 'n.id = ns.notification');

        if ($nid) {
            $qb->andWhere($qb->expr()->eq('n.id', ':nid'));
            $qb->setParameter('nid', $nid);
        }

        if ($user) {
            $qb->andWhere($qb->expr()->eq('ns.target', ':user'));
            $qb->setParameter('user', $user->getId());
        }

        if ($status) {
            $qb->andWhere($qb->expr()->eq('ns.status', ':status'));
            $qb->setParameter('status', $status);
        }
        $qb->orderBy('n.createdDate', 'DESC');
        return $qb->getQuery()->getResult();
    }
}

<?php

/**
 * General class.
 *
 * PHP version 5.4
 *
 * @category General
 * @package  Desyncr\Connected\DoctrineTest\Service
 * @author   Dario Cavuotti <dc@syncr.com.ar>
 * @license  https://www.gnu.org/licenses/gpl.html GPL-3.0+
 * @version  GIT:<>
 * @link     https://github.com/desyncr
 */
namespace Desyncr\Connected\DoctrineTest\Service;

use Desyncr\Connected\DoctrineTest\Base\TestDBBase;

/**
 * Class DoctrineServiceTestBase
 *
 * @category General
 * @package  Desyncr\Connected\DoctrineTest\Service
 * @author   Dario Cavuotti <dc@syncr.com.ar>
 * @license  https://www.gnu.org/licenses/gpl.html GPL-3.0+
 * @link     https://github.com/desyncr
 */
class DoctrineServiceTestBase extends TestDBBase
{
    /**
     * getService
     *
     * @return \Desyncr\Connected\Doctrine\Service\DoctrineService
     */
    public function getService()
    {
        return $this->getServiceManager()->get('Desyncr\Connected\Doctrine\Service\DoctrineService');
    }

    public function findNotification($arr)
    {
        $em = $this->getEntityManager();

        $notifications = $em->getRepository(
            'Desyncr\Connected\Doctrine\Entity\Notification'
        );

        /** @var \Desyncr\Connected\Doctrine\Entity\Notification $notification */
        return $notifications->findOneBy($arr);
    }
}
 
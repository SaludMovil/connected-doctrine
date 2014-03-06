<?php
/**
 * Desyncr\Connected\Doctrine
 *
 * PHP version 5.4
 *
 * @category General
 * @package  Desyncr\Connected\Doctrine
 * @author   Dario Cavuotti <dc@syncr.com.ar>
 * @license  https://www.gnu.org/licenses/gpl.html GPL-3.0+
 * @version  GIT:<>
 * @link     https://github.com/desyncr
 */
return array(
    'connected' => array(
        'doctrine-adapter' => array(
            'entity' => 'Core\Model\Notification',
            'status' => 'Core\Model\NotificationStatus'
        )
    ),
    'factories' => array(
        'Desyncr\Connected\Doctrine\Service\DoctrineService'
        => 'Desyncr\Connected\Doctrine\Factory\DoctrineServiceFactory'
    )
);

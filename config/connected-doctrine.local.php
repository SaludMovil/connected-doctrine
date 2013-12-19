<?php
return array(
    'connected' => array(
        'doctrine-adapter' => array(
            'entity' => 'Core\Model\Notification',
            'status' => 'Core\Model\NotificationStatus'
        )
    ),
    'factories' => array(
        'Desyncr\Connected\Doctrine\Service\DoctrineService'  => 'Desyncr\Connected\Doctrine\Factory\DoctrineServiceFactory'
    )
);

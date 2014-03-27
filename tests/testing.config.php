<?php
/**
 * Database global configuration
 */
return array(
    'connected' => array(
        'doctrine-adapter' => array(
            'entity'    => 'Desyncr\Connected\Doctrine\Entity\Notification',
            'target'    => 'Desyncr\Connected\Doctrine\Entity\NotificationTarget',
            'property'  => 'Desyncr\Connected\Doctrine\Entity\NotificationProperty'
        )
    ),
    'doctrine' => array(
        'driver' => array(
            'application_entities' => array(
                'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Desyncr/Connected/Doctrine/Entity')
            ),

            'orm_default' => array(
                'drivers' => array(
                    'Desyncr\Connected\Doctrine\Entity' => 'application_entities'
                )
            )
        ),
        'connection' => array(
            'orm_default' => array(
                'params' => array(
                    'driverClass' => 'Doctrine\DBAL\Driver\PDOSqlite\Driver',
                    'driver'   => 'pdo_sqlite',
                    'memory'   => true
                ),
                'doctrine_type_mappings' => array(
                    'bit' => 'boolean',
                ),
            ),
        )
    ),
);

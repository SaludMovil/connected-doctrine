<?php
return array(
    'factories' => array(
        'Desyncr\Connected\Doctrine\Service\DoctrineService'  => 'Desyncr\Connected\Doctrine\Factory\DoctrineServiceFactory'
    ),
    'doctrine' => array(
        'driver' => array(
            'connected_doctrine_driver' => array(
                'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Desyncr/Connected/Doctrine/Entity')
            ),

            'orm_default' => array(
                'drivers' => array(
                    'Desyncr\Connected\Doctrine' => 'connected_doctrine_driver'
                )
            )
        )
    )
);

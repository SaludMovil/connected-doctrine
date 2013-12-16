<?php
return array(
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

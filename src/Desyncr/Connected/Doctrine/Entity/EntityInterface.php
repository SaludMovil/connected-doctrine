<?php
namespace Desyncr\Connected\Doctrine\Entity;

interface EntityInterface {
    public function setType($type);
    public function addTarget($target);
    public function setText($text);

} 
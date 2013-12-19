<?php
namespace Desyncr\Connected\Doctrine\Entity;

interface TargetInterface {
    public function setTarget($entity);
    public function setStatus($status);
} 
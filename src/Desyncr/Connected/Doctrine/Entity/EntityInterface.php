<?php
/**
 * Desyncr\Connected\Doctrine\Entity
 *
 * PHP version 5.4
 *
 * @category General
 * @package  Desyncr\Connected\Doctrine\Entity
 * @author   Dario Cavuotti <dc@syncr.com.ar>
 * @license  https://www.gnu.org/licenses/gpl.html GPL-3.0+
 * @version  GIT:<>
 * @link     https://github.com/desyncr
 */
namespace Desyncr\Connected\Doctrine\Entity;

/**
 * Interface EntityInterface
 *
 * @package Desyncr\Connected\Doctrine\Entity
 */
interface EntityInterface
{
    /**
     * setType
     *
     * @param String $type Type
     *
     * @return mixed
     */
    public function setType($type);

    /**
     * addTarget
     *
     * @param Object $target Target
     *
     * @return mixed
     */
    public function addTarget($target);

    /**
     * setText
     *
     * @param String $text Text
     *
     * @return mixed
     */
    public function setText($text);
} 
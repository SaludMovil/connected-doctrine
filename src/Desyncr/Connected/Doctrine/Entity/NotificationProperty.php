<?php
/**
 * Desyncr\Connected\Doctrine\Entity
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
namespace Desyncr\Connected\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NotificationProperty
 * @ORM\Entity
 * @ORM\Table(name="notification_property")
 */
class NotificationProperty
{
    /**
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var \Desyncr\Connected\Doctrine\Entity\Notification
     *
     * @ORM\ManyToOne(
     *      targetEntity = "Notification",
     *      inversedBy = "properties",
     *      cascade = {"persist"}
     * )
     * @ORM\JoinColumn(
     *      name = "notification_id",
     *      referencedColumnName = "id",
     *      nullable = false
     * )
     */
    protected $notification;

    /**
     * @var String $name
     *
     * @ORM\Column(type="string", length=256, nullable=false)
     */
    protected $name;

    /**
     * @var String value
     *
     * @ORM\Column(type="string", length=2048, nullable=true)
     */
    protected $value;

    /**
     * setId
     *
     * @param mixed $id Variable
     *
     * @return int
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * getId
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * setName
     *
     * @param mixed $name Variable
     *
     * @return String
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * getName
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * setNotification
     *
     * @param Notification $notification Notification object
     *
     * @return null
     */
    public function setNotification($notification)
    {
        $this->notification = $notification;
    }

    /**
     * getNotification
     *
     * @return Notification
     */
    public function getNotification()
    {
        return $this->notification;
    }

    /**
     * setValue
     *
     * @param mixed $value Variable
     *
     * @return null
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * getValue
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}
 
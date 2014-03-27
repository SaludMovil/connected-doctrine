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
namespace Desyncr\Connected\Doctrine\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * NotificationTarget
 * @ORM\Entity
 * @ORM\Table(name="notification_target")
 * @ORM\HasLifecycleCallbacks
 */
class NotificationTarget
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
     *      inversedBy = "targets",
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
     * @ORM\Column(type="integer", nullable=false)
     */
    protected $target_id;

    /**
     * @ORM\Column(type="string", length=256, nullable=false)
     */
    protected $target_entity;


    /**
     * @ORM\Column(type="string", length=256, nullable=false)
     */
    protected $class;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    protected $status = 0;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_date", type="datetimetz", nullable=true)
     */
    protected $updateDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_date", type="datetimetz", nullable=false)
     */
    protected $createDate;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setClass(get_class($this));
    }

    /**
     * setId
     *
     * @param mixed $id ID
     *
     * @return null
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
     * setStatus
     *
     * @param string $status Status
     *
     * @return null
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * getStatus
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }


    /**
     * setTargetId
     *
     * @param integer $target_id Target id
     *
     * @return null
     */
    public function setTargetId($target_id)
    {
        $this->target_id = $target_id;
    }

    /**
     * getTargetId
     *
     * @return integer
     */
    public function getTargetId()
    {
        return $this->target_id;
    }

    /**
     * setTargetEntity
     *
     * @param string $target_entity EEntity
     *
     * @return null
     */
    public function setTargetEntity($target_entity)
    {
        $this->target_entity = $target_entity;
    }

    /**
     * getTargetEntity
     *
     * @return string
     */
    public function getTargetEntity()
    {
        return $this->target_entity;
    }

    /**
     * setClass
     *
     * @param mixed $class Variable
     *
     * @return null
     */
    public function setClass($class)
    {
        $this->class = $class;
    }

    /**
     * getClass
     *
     * @return mixed
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * setNotification
     *
     * @param Notification $n Notification object
     *
     * @return mixed
     */
    public function setNotification($n)
    {
        $this->notification = $n;
    }

    /**
     * getNotification
     *
     * @return mixed
     */
    public function getNotification()
    {
        return $this->notification;
    }

    /**
     * setCreateDate
     *
     * @param \DateTime $createDate Create date
     *
     * @return mixed
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;
    }

    /**
     * getCreateDate
     *
     * @return mixed
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * setUpdateData
     *
     * @param \DateTime $updateDate Update date
     *
     * @return mixed
     */
    public function setUpdateDate($updateDate)
    {
        $this->updateDate = $updateDate;
    }

    /**
     * getUpdateDate
     *
     * @return mixed
     */
    public function getUpdateDate()
    {
        return $this->updateDate;
    }

    /**
     * prePersist
     *
     * @ORM\PrePersist
     * @return null
     */
    public function prePersist()
    {
        $this->setCreateDate(new \DateTime());
    }

    /**
     * preUpdate
     *
     * @ORM\PreUpdate
     * @return null
     */
    public function preUpdate()
    {
        $this->setUpdateDate(new \DateTime());
    }
}

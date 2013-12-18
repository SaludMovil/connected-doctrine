<?php
namespace Desyncr\Connected\Doctrine\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * NotificationStatus
 * @ORM\Entity(repositoryClass="Desyncr\Connected\Doctrine\Entity\Repository\NotificationStatusRepository")
 * @ORM\Table(name="persistent_notification_status")
 */
class NotificationStatus {

    /**
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Notification")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="notification_id", referencedColumnName="id")
     * })
     * @ORM\Column(type="integer", nullable=false)
     */
    protected $notification;


    /**
     * @var \Target
     *
     * @ORM\ManyToOne(targetEntity="Core\Model\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     * })
     * @ORM\Column(name="target", type="integer", nullable=false)
     */
    protected $target;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=15, nullable=false)
     */
    protected $status = 'unread';

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Users $notification
     */
    public function setNotification($notification)
    {
        $this->notification = $notification;
    }

    /**
     * @return \Users
     */
    public function getNotification()
    {
        return $this->notification;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param \User $target
     */
    public function setTarget($target)
    {
        $this->target = $target;
    }

    /**
     * @return \Target
     */
    public function getTarget()
    {
        return $this->target;
    }

}

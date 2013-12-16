<?php
namespace Desyncr\Connected\Doctrine\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Notification
 * @ORM\Entity
 * @ORM\Table(name="persistent_notification")
 */
class Notification {

    /**
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=15, nullable=true)
     */
    protected $status = 'unread';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_date", type="time", nullable=true)
     */
    protected $createdDate = 'now()';

    /**
     * @var string
     * @ORM\Column(name="body", type="string", length=256, nullable=false)
     */
    protected $body = '';

    /**
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param \DateTime $createdDate
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

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

}

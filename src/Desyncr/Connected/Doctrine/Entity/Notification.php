<?php
namespace Desyncr\Connected\Doctrine\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Notification
 * @ORM\Entity(repositoryClass="Desyncr\Connected\Doctrine\Entity\Repository\NotificationRepository")
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
     * @ORM\Column(name="title", type="string", length=256, nullable=false)
     */
    protected $title = '';

    /**
     * @var string
     * @ORM\Column(name="text", type="string", length=2048, nullable=true)
     */
    protected $text = '';

    /**
     * @var string
     * @ORM\Column(name="type", type="string", length=256, nullable=false)
     */
    protected $type = 'info';

    /**
     * @var \Target
     *
     * @ORM\ManyToOne(targetEntity="Core\Model\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     * })
     * @ORM\Column(name="target", type="integer", nullable=false);
     */
    protected $target;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_date", type="time", nullable=true)
     */
    protected $createdDate = 'now()';

    public function __construct() {
        $this->createdDate = new \DateTime();
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
     * @param \type $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return \type
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param \status $target
     */
    public function setTarget($target)
    {
        $this->target = $target;
    }

    /**
     * @return \target
     */
    public function getTarget()
    {
        return $this->target;
    }

}

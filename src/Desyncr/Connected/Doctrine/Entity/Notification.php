<?php
/**
 * Core\Model
 *
 * PHP version 5.4
 *
 * @category General
 * @package  Core\Model
 * @author   Dario Cavuotti <dc@syncr.com.ar>
 * @license  https://www.gnu.org/licenses/gpl.html GPL-3.0+
 * @version  GIT:<>
 * @link     https://github.com/desyncr
 */
namespace Desyncr\Connected\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Notification
 * @ORM\Entity
 * @ORM\Table(name="notification")
 * @ORM\HasLifecycleCallbacks
 */
class Notification implements EntityInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(
     *      type = "integer",
     *      nullable = false
     * )
     */
    protected $id;

    /**
     * @ORM\Column(name="unique_id", unique=true, type="string", nullable=false)
     */
    protected $unique;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(
     *      targetEntity = "NotificationTarget",
     *      mappedBy = "notification",
     *      cascade = {"persist"}
     * )
     */
    protected $targets;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(
     *      targetEntity = "NotificationProperty",
     *      mappedBy = "notification",
     *      cascade = {"persist"}
     * )
     */
    protected $properties;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="integer", nullable=true)
     */
    protected $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_date", type="datetimetz", nullable=false)
     */
    protected $createDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_date", type="datetimetz", nullable=true)
     */
    protected $updateDate;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setCreateDate(new \DateTime());
        $this->setUnique(sha1(rand() + time()));
        $this->setTargets(new ArrayCollection());
        $this->setProperties(new ArrayCollection());
    }


    /**
     * setId
     *
     * @param Integer $id Id
     *
     * @return mixed
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
     * @param Integer $status Status
     *
     * @return mixed
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * getStatus
     *
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * addTarget
     *
     * @param mixed $object Target
     *
     * @return mixed
     */
    public function addTarget($object)
    {
        $target = new NotificationTarget();
        $target->setTargetEntity(get_class($object));
        $target->setTargetId($object->getId());
        $target->setNotification($this);
        $this->getTargets()->add($target);
    }

    /**
     * setTargets
     *
     * @param ArrayCollection $targets Targets array
     *
     * @return mixed
     */
    public function setTargets(ArrayCollection $targets)
    {
        $this->targets = $targets;
    }

    /**
     * getTargets
     *
     * @return ArrayCollection
     */
    public function getTargets()
    {
        return $this->targets;
    }

    /**
     * addProperty
     *
     * @param String $name  Property name
     * @param mixed  $value Property value
     *
     * @return mixed
     */
    public function addProperty($name, $value)
    {
        $property = new NotificationProperty();
        $property->setNotification($this);
        $property->setName($name);
        $property->setValue($value);
        $this->getProperties()->add($property);
    }

    /**
     * setProperties
     *
     * @param ArrayCollection $properties Properties
     *
     * @return mixed
     */
    public function setProperties(ArrayCollection $properties)
    {
        $this->properties = $properties;
    }

    /**
     * getProperties
     *
     * @return ArrayCollection
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * setCreateDate
     *
     * @param \DateTime $createDate Created date
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
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * setUpdateDate
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
     * Deprecated getUpdatedDate
     *
     * @return \DateTime
     */
    public function getUpdatedDate()
    {
        return $this->getUpdateDate();
    }

    /**
     * getUpdateDate
     *
     * @return \DateTime
     */
    public function getUpdateDate()
    {
        return $this->updateDate;
    }

    /**
     * setUnique
     *
     * @param String $unique Unique sha1-like string
     *
     * @return mixed
     */
    public function setUnique($unique)
    {
        $this->unique = $unique;
    }

    /**
     * getUnique
     *
     * @return mixed
     */
    public function getUnique()
    {
        return $this->unique;
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

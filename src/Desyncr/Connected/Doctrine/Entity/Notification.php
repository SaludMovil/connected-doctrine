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

}

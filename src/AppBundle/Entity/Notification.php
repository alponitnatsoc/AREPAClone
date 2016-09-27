<?php
/**
 * Created by PhpStorm.
 * User: erikaxu
 * Date: 26/09/16
 * Time: 04:36 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class Notification
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="notification")
 * @ORM\Entity
 */
class Notification
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_notification",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idNotification;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Element", mappedBy="notificationNotification", cascade={"persist", "remove"})
     */
    private $elementElement;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PersonNotification", mappedBy="notificationNotification", cascade={"persist", "remove"})
     */
    private $personNotification;
}
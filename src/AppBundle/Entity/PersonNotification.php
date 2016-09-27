<?php
/**
 * Created by PhpStorm.
 * User: erikaxu
 * Date: 27/09/16
 * Time: 07:02 AM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class PersonNotification
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="person_notification")
 * @ORM\Entity
 */
class personNotification
{
    /**
     * @var integer
     * @ORM\Column(name="id_person_notification",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idPersonNotification;

    /**
     * @var Notification
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Notification", inversedBy="personNotification")
     * @ORM\JoinColumn(name="notification_id", referencedColumnName="id_notification")
     */
    private $notificationNotification;

    /**
     * @var Person
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Person", inversedBy="personNotification")
     * @ORM\JoinColumn(name="person_id", referencedColumnName="id_person")
     */
    private $personPerson;

}
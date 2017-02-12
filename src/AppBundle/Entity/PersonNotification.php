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
class PersonNotification
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


    /**
     * Get idPersonNotification
     *
     * @return integer
     */
    public function getIdPersonNotification()
    {
        return $this->idPersonNotification;
    }

    /**
     * Set notificationNotification
     *
     * @param \AppBundle\Entity\Notification $notificationNotification
     *
     * @return PersonNotification
     */
    public function setNotificationNotification(\AppBundle\Entity\Notification $notificationNotification = null)
    {
        $this->notificationNotification = $notificationNotification;

        return $this;
    }

    /**
     * Get notificationNotification
     *
     * @return \AppBundle\Entity\Notification
     */
    public function getNotificationNotification()
    {
        return $this->notificationNotification;
    }

    /**
     * Set personPerson
     *
     * @param \AppBundle\Entity\Person $personPerson
     *
     * @return PersonNotification
     */
    public function setPersonPerson(\AppBundle\Entity\Person $personPerson = null)
    {
        $this->personPerson = $personPerson;

        return $this;
    }

    /**
     * Get personPerson
     *
     * @return \AppBundle\Entity\Person
     */
    public function getPersonPerson()
    {
        return $this->personPerson;
    }
}

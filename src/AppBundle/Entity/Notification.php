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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Person",inversedBy="notifications")
     * @ORM\JoinColumn(name="person_id",referencedColumnName="id_person")
     */
    private $sender;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Element", mappedBy="notificationNotification", cascade={"persist", "remove"})
     */
    private $elementElement;

    /**
     * @var \DateTime
     * @ORM\Column(name="created_at",type="datetime",nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PersonNotification", mappedBy="notificationNotification", cascade={"persist", "remove"})
     */
    private $personNotification;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->elementElement = new \Doctrine\Common\Collections\ArrayCollection();
        $this->personNotification = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get idNotification
     *
     * @return integer
     */
    public function getIdNotification()
    {
        return $this->idNotification;
    }

    /**
     * Set sender
     *
     * @param \AppBundle\Entity\Person $sender
     *
     * @return Notification
     */
    public function setSender(\AppBundle\Entity\Person $sender = null)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * Get sender
     *
     * @return \AppBundle\Entity\Person
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Add elementElement
     *
     * @param \AppBundle\Entity\Element $elementElement
     *
     * @return Notification
     */
    public function addElementElement(\AppBundle\Entity\Element $elementElement)
    {
        $this->elementElement[] = $elementElement;

        return $this;
    }

    /**
     * Remove elementElement
     *
     * @param \AppBundle\Entity\Element $elementElement
     */
    public function removeElementElement(\AppBundle\Entity\Element $elementElement)
    {
        $this->elementElement->removeElement($elementElement);
    }

    /**
     * Get elementElement
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getElementElement()
    {
        return $this->elementElement;
    }

    /**
     * Add personNotification
     *
     * @param \AppBundle\Entity\PersonNotification $personNotification
     *
     * @return Notification
     */
    public function addPersonNotification(\AppBundle\Entity\PersonNotification $personNotification)
    {
        $this->personNotification[] = $personNotification;

        return $this;
    }

    /**
     * Remove personNotification
     *
     * @param \AppBundle\Entity\PersonNotification $personNotification
     */
    public function removePersonNotification(\AppBundle\Entity\PersonNotification $personNotification)
    {
        $this->personNotification->removeElement($personNotification);
    }

    /**
     * Get personNotification
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPersonNotification()
    {
        return $this->personNotification;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Notification
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}

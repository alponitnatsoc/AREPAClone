<?php
/**
 * Created by PhpStorm.
 * User: erikaxu
 * Date: 26/09/16
 * Time: 05:03 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
/**
 * Class Element
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="element")
 * @ORM\Entity
 */
class Element
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_element",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idElement;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="data", type="string")
     */
    private $data;

    /**
     * @var string
     *
     * @ORM\Column(name="type_data", type="string")
     */
    private $typeData;

    /**
     * @var Notification
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Notification", inversedBy="elementElement")
     * @ORM\JoinColumn(name="notification_id", referencedColumnName="id_notification")
     */
    private $notificationNotification;

}
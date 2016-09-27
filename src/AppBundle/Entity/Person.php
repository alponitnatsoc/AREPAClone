<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 13/09/16
 * Time: 09:18 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Person
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="person")
 * @ORM\Entity
 */
class Person
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_person",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idPerson;

    /**
     * @var string
     * @ORM\Column(type="string",nullable=true)
     */
    private $firstName;

    /**
     * @var string
     * @ORM\Column(type="string",nullable=true)
     */
    private $secondName;

    /**
     * @var string
     * @ORM\Column(type="string",nullable=true)
     */
    private $lastName1;

    /**
     * @var string
     * @ORM\Column(type="string",nullable=true)
     */
    private $lastName2;

    /**
     * @var string
     * @ORM\Column(name="document_type", type="string", length=2, nullable=true)
     */
    private $documentType;

    /**
     * @var string
     * @ORM\Column(type="string",nullable=true)
     */
    private $document;

    /**
     * @var Student
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Student", mappedBy="personPerson", cascade={"persist","remove"},)
     */
    private $student;

    /**
     * @var Teacher
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Teacher", mappedBy="personPerson", cascade={"persist","remove"})
     */
    private $teacher;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PersonNotification", mappedBy="personPerson", cascade={"persist", "remove"})
     */
    private $personNotification;

    //TODO
    /**
     * @var string
     */
    private $userUser;

}

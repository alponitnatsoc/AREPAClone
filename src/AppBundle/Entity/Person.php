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
     * @ORM\Column(type="string",nullable=true)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $secondName;

    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $lastName1;

    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $lastName2;

    /**
     * @var string
     * @ORM\Column(name="document_type", type="string", length=2, nullable=true)
     */
    private $documentType;

    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $document;

    /**
     * @var Student
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Student", mappedBy="idStudent", cascade={"persist"})
     */
    private $student;

    /**
     * @var Teacher
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Student", mappedBy="idTeacher", cascade={"persist"})
     */
    private $teacher;

}

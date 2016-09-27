<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 13/09/16
 * Time: 09:55 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;


/**
 * Class Student
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="student",
 *     uniqueConstraints={
 *          @UniqueConstraint(
 *              name="personStudentUnique", columns={"id_student", "person_id_person"}
 *          )
 *     })
 * @ORM\Entity
 */

class Student
{
    /**
     * @var integer
     * @ORM\Column(name="id_student",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idStudent;

    /**
     * @var string
     *
     * @ORM\Column(name="code_student",type="string",nullable=true)
     */
    private $studentCode;

    /**
     * @var float
     *
     * @ORM\Column(name="grade_point_average",type="float")
     */
    private $gradePointAverage=0.0;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $aprovedCredits=0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_monitor",type="boolean")
     */
    private $isMonitor = false;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\StudentAssistClass",mappedBy="studentStudent",cascade={"persist", "remove"})
     */
    private $studentAssistClasses;

    /**
     * @var Person
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Person",inversedBy="idPerson", cascade={"persist"})
     * @ORM\JoinColumn(name="person_id_person",referencedColumnName="id_person")
     */
    private $personPerson;
}

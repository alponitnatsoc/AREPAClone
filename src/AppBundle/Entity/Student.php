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
     *
     * @ORM\Column(name="id_student",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idStudent;

    /**
     * @var Person
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Person",inversedBy="idPerson", cascade={"persist"})
     * @ORM\JoinColumn(name="person_id_person",referencedColumnName="id_person")
     */
    private $personPerson;

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
     * Get idStudent
     *
     * @return integer
     */
    public function getIdStudent()
    {
        return $this->idStudent;
    }

    /**
     * Set studentCode
     *
     * @param string $studentCode
     *
     * @return Student
     */
    public function setStudentCode($studentCode)
    {
        $this->studentCode = $studentCode;

        return $this;
    }

    /**
     * Get studentCode
     *
     * @return string
     */
    public function getStudentCode()
    {
        return $this->studentCode;
    }

    /**
     * Set gradePointAverage
     *
     * @param float $gradePointAverage
     *
     * @return Student
     */
    public function setGradePointAverage($gradePointAverage)
    {
        $this->gradePointAverage = $gradePointAverage;

        return $this;
    }

    /**
     * Get gradePointAverage
     *
     * @return float
     */
    public function getGradePointAverage()
    {
        return $this->gradePointAverage;
    }

    /**
     * Set personPerson
     *
     * @param \AppBundle\Entity\Person $personPerson
     *
     * @return Student
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

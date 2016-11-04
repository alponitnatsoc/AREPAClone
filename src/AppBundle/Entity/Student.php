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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\FacultyHasStudents", mappedBy="studentStudent", cascade={"persist", "remove"})
     */
    private $studentHasFaculty;

    /**
     * @var Person
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Person",inversedBy="student", cascade={"persist"})
     * @ORM\JoinColumn(name="person_id_person",referencedColumnName="id_person")
     */
    private $personPerson;
    

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
     * Set aprovedCredits
     *
     * @param integer $aprovedCredits
     *
     * @return Student
     */
    public function setAprovedCredits($aprovedCredits)
    {
        $this->aprovedCredits = $aprovedCredits;

        return $this;
    }

    /**
     * Get aprovedCredits
     *
     * @return integer
     */
    public function getAprovedCredits()
    {
        return $this->aprovedCredits;
    }

    /**
     * Set isMonitor
     *
     * @param boolean $isMonitor
     *
     * @return Student
     */
    public function setIsMonitor($isMonitor)
    {
        $this->isMonitor = $isMonitor;

        return $this;
    }

    /**
     * Get isMonitor
     *
     * @return boolean
     */
    public function getIsMonitor()
    {
        return $this->isMonitor;
    }

    /**
     * Add studentAssistClass
     *
     * @param \AppBundle\Entity\StudentAssistClass $studentAssistClass
     *
     * @return Student
     */
    public function addStudentAssistClass(\AppBundle\Entity\StudentAssistClass $studentAssistClass)
    {
        $this->studentAssistClasses[] = $studentAssistClass;
        return $this;
    }

    /**
     * Remove studentAssistClass
     *
     * @param \AppBundle\Entity\StudentAssistClass $studentAssistClass
     */
    public function removeStudentAssistClass(\AppBundle\Entity\StudentAssistClass $studentAssistClass)
    {
        $this->studentAssistClasses->removeElement($studentAssistClass);
    }

    /**
     * Get studentAssistClasses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStudentAssistClasses()
    {
        return $this->studentAssistClasses;
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

    /**
     * Add studentHasFaculty
     *
     * @param \AppBundle\Entity\FacultyHasStudents $studentHasFaculty
     *
     * @return Student
     */
    public function addStudentHasFaculty(\AppBundle\Entity\FacultyHasStudents $studentHasFaculty)
    {
        $this->studentHasFaculty[] = $studentHasFaculty;

        return $this;
    }

    /**
     * Remove studentHasFaculty
     *
     * @param \AppBundle\Entity\FacultyHasStudents $studentHasFaculty
     */
    public function removeStudentHasFaculty(\AppBundle\Entity\FacultyHasStudents $studentHasFaculty)
    {
        $this->studentHasFaculty->removeElement($studentHasFaculty);
    }

    /**
     * Get studentHasFaculty
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStudentHasFaculty()
    {
        return $this->studentHasFaculty;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->studentAssistClasses = new \Doctrine\Common\Collections\ArrayCollection();
        $this->studentHasFaculty = new \Doctrine\Common\Collections\ArrayCollection();
    }

}

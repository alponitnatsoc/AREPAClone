<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 13/09/16
 * Time: 10:14 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Class Student
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="teacher",
 *     uniqueConstraints={
 *          @UniqueConstraint(
 *              name="personTeacherUnique", columns={"id_teacher", "person_id_person"}
 *          )
 *     })
 * @ORM\Entity
 */
class Teacher
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id_teacher",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idTeacher;

    /**
     * @var Person
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Person",inversedBy="teacher", cascade={"persist"})
     * @ORM\JoinColumn(name="person_id_person",referencedColumnName="id_person")
     */
    private $personPerson;

    /**
     * @var string
     *
     * @ORM\Column(name="code_teacher",type="string",nullable=true)
     */
    private $teacherCode;

    /**
     * @ORM\OneToMany( targetEntity="AppBundle\Entity\TeacherHasRole" , mappedBy="teacherTeacher", cascade={"persist","remove"})
     */
    private $teacherHasRoles;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\TeacherDictatesCourse",mappedBy="teacherTeacher",cascade={"persist","remove"})
     */
    private $teacherDictatesCourses;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\FacultyHasTeachers",mappedBy="teacherTeacher",cascade={"persist","remove"})
     */
    private $teacherHasfaculty;

    /**
     * @ORM\Column(name="created_at",type="datetime", nullable=true)
     */
    private $createdAt = null;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->teacherHasRoles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->teacherDictatesCourses = new \Doctrine\Common\Collections\ArrayCollection();
        $this->teacherHasfaculty = new \Doctrine\Common\Collections\ArrayCollection();
        $this->createdAt = new \DateTime();
    }

    /**
     * Get idTeacher
     *
     * @return integer
     */
    public function getIdTeacher()
    {
        return $this->idTeacher;
    }

    /**
     * Set teacherCode
     *
     * @param string $teacherCode
     *
     * @return Teacher
     */
    public function setTeacherCode($teacherCode)
    {
        $this->teacherCode = $teacherCode;

        return $this;
    }

    /**
     * Get teacherCode
     *
     * @return string
     */
    public function getTeacherCode()
    {
        return $this->teacherCode;
    }

    /**
     * Set personPerson
     *
     * @param \AppBundle\Entity\Person $personPerson
     *
     * @return Teacher
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
     * Add teacherHasRole
     *
     * @param \AppBundle\Entity\TeacherHasRole $teacherHasRole
     *
     * @return Teacher
     */
    public function addTeacherHasRole(\AppBundle\Entity\TeacherHasRole $teacherHasRole)
    {
        $this->teacherHasRoles[] = $teacherHasRole;

        return $this;
    }

    /**
     * Remove teacherHasRole
     *
     * @param \AppBundle\Entity\TeacherHasRole $teacherHasRole
     */
    public function removeTeacherHasRole(\AppBundle\Entity\TeacherHasRole $teacherHasRole)
    {
        $this->teacherHasRoles->removeElement($teacherHasRole);
    }

    /**
     * Get teacherHasRoles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTeacherHasRoles()
    {
        return $this->teacherHasRoles;
    }

    /**
     * Add teacherDictatesCourse
     *
     * @param \AppBundle\Entity\TeacherDictatesCourse $teacherDictatesCourse
     *
     * @return Teacher
     */
    public function addTeacherDictatesCourse(\AppBundle\Entity\TeacherDictatesCourse $teacherDictatesCourse)
    {
        $this->teacherDictatesCourses[] = $teacherDictatesCourse;

        return $this;
    }

    /**
     * Remove teacherDictatesCourse
     *
     * @param \AppBundle\Entity\TeacherDictatesCourse $teacherDictatesCourse
     */
    public function removeTeacherDictatesCourse(\AppBundle\Entity\TeacherDictatesCourse $teacherDictatesCourse)
    {
        $this->teacherDictatesCourses->removeElement($teacherDictatesCourse);
    }

    /**
     * Get teacherDictatesCourses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTeacherDictatesCourses()
    {
        return $this->teacherDictatesCourses;
    }

    /**
     * Add teacherHasfaculty
     *
     * @param \AppBundle\Entity\FacultyHasTeachers $teacherHasfaculty
     *
     * @return Teacher
     */
    public function addTeacherHasfaculty(\AppBundle\Entity\FacultyHasTeachers $teacherHasfaculty)
    {
        $this->teacherHasfaculty[] = $teacherHasfaculty;

        return $this;
    }

    /**
     * Remove teacherHasfaculty
     *
     * @param \AppBundle\Entity\FacultyHasTeachers $teacherHasfaculty
     */
    public function removeTeacherHasfaculty(\AppBundle\Entity\FacultyHasTeachers $teacherHasfaculty)
    {
        $this->teacherHasfaculty->removeElement($teacherHasfaculty);
    }

    /**
     * Get teacherHasfaculty
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTeacherHasfaculty()
    {
        return $this->teacherHasfaculty;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Teacher
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

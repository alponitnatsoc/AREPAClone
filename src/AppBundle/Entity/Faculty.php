<?php
/**
 * Created by PhpStorm.
 * User: andresfelipe
 * Date: 10/20/16
 * Time: 8:20 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class Section
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="faculty",
 *     uniqueConstraints={
 *          @UniqueConstraint(
 *              name="codeFacultyUnique", columns={"faculty_code"}
 *          )
 *     })
 * @ORM\Entity
 */
class Faculty
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_faculty",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idFaculty;

    /**
     * @var string
     *
     * @ORM\Column(name="faculty_code",type="string", length=11, nullable=true, unique=true)
     */
    private $facultyCode;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\FacultyHasCourses", mappedBy="facultyFaculty", cascade={"persist", "remove"})
     */
    private $facultyHasCourses;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\FacultyHasTeachers", mappedBy="facultyFaculty", cascade={"persist", "remove"})
     */
    private $facultyHasTeacher;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\FacultyHasStudents", mappedBy="facultyFaculty", cascade={"persist", "remove"})
     */
    private $facultyHasStudents;

    /**
     * @var string
     * @ORM\Column(name="name",type="string",nullable=true,unique=true)
     */
    private $name;

    /**
     * Get idFaculty
     *
     * @return integer
     */
    public function getIdFaculty()
    {
        return $this->idFaculty;
    }

    /**
     * Set facultyCode
     *
     * @param string $facultyCode
     *
     * @return Faculty
     */
    public function setFacultyCode($facultyCode)
    {
        $this->facultyCode = $facultyCode;

        return $this;
    }

    /**
     * Get facultyCode
     *
     * @return string
     */
    public function getFacultyCode()
    {
        return $this->facultyCode;
    }

    /**
     * Add facultyHasCourse
     *
     * @param \AppBundle\Entity\FacultyHasCourses $facultyHasCourse
     *
     * @return Faculty
     */
    public function addFacultyHasCourse(\AppBundle\Entity\FacultyHasCourses $facultyHasCourse)
    {
        $this->facultyHasCourses[] = $facultyHasCourse;

        return $this;
    }

    /**
     * Remove facultyHasCourse
     *
     * @param \AppBundle\Entity\FacultyHasCourses $facultyHasCourse
     */
    public function removeFacultyHasCourse(\AppBundle\Entity\FacultyHasCourses $facultyHasCourse)
    {
        $this->facultyHasCourses->removeElement($facultyHasCourse);
    }

    /**
     * Get facultyHasCourses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFacultyHasCourses()
    {
        return $this->facultyHasCourses;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Faculty
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add facultyHasTeacher
     *
     * @param \AppBundle\Entity\FacultyHasTeachers $facultyHasTeacher
     *
     * @return Faculty
     */
    public function addFacultyHasTeacher(\AppBundle\Entity\FacultyHasTeachers $facultyHasTeacher)
    {
        $this->facultyHasTeacher[] = $facultyHasTeacher;

        return $this;
    }

    /**
     * Remove facultyHasTeacher
     *
     * @param \AppBundle\Entity\FacultyHasTeachers $facultyHasTeacher
     */
    public function removeFacultyHasTeacher(\AppBundle\Entity\FacultyHasTeachers $facultyHasTeacher)
    {
        $this->facultyHasTeacher->removeElement($facultyHasTeacher);
    }

    /**
     * Get facultyHasTeacher
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFacultyHasTeacher()
    {
        return $this->facultyHasTeacher;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->facultyHasCourses = new \Doctrine\Common\Collections\ArrayCollection();
        $this->facultyHasTeacher = new \Doctrine\Common\Collections\ArrayCollection();
        $this->facultyHasStudents = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add facultyHasStudent
     *
     * @param \AppBundle\Entity\FacultyHasStudents $facultyHasStudent
     *
     * @return Faculty
     */
    public function addFacultyHasStudent(\AppBundle\Entity\FacultyHasStudents $facultyHasStudent)
    {
        $this->facultyHasStudents[] = $facultyHasStudent;

        return $this;
    }

    /**
     * Remove facultyHasStudent
     *
     * @param \AppBundle\Entity\FacultyHasStudents $facultyHasStudent
     */
    public function removeFacultyHasStudent(\AppBundle\Entity\FacultyHasStudents $facultyHasStudent)
    {
        $this->facultyHasStudents->removeElement($facultyHasStudent);
    }

    /**
     * Get facultyHasStudents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFacultyHasStudents()
    {
        return $this->facultyHasStudents;
    }
}

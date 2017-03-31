<?php
/**
 * Created by PhpStorm.
 * User: andresfelipe
 * Date: 10/20/16
 * Time: 8:20 PM
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class Section
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="faculty")
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
     * @var string
     * @ORM\Column(name="name",type="string",nullable=true,unique=true)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Role", inversedBy="faculties",cascade={"persist"})
     * @ORM\JoinTable(name="faculty_has_roles",
     *      joinColumns={@ORM\JoinColumn(name="faculty_id",referencedColumnName="id_faculty")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="role_id",referencedColumnName="id_role")}
     *     )
     */
    private $roles;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Course", inversedBy="faculties", cascade={"persist"})
     * @ORM\JoinTable(name="faculty_has_courses",
     *      joinColumns={@ORM\JoinColumn(name="faculty_id",referencedColumnName="id_faculty")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="course_id",referencedColumnName="id_course")}
     *     )
     */
    private $courses;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Section", mappedBy="faculty", cascade={"persist"})
     */
    private $sections;

    /**
     * Get Teachers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTeachers()
    {
        return $this->roles->filter(function($role){return $role->getClass()=='Teacher';});
    }

    /**
     * Get Teachers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStudents()
    {
        return $this->roles->filter(function($role){return $role->getClass()=='Student';});
    }

    /**
     * Get TeacherAssistants
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTeacherAssistants()
    {
        return $this->roles->filter(function($role){return $role->getClass()=='TeacherAssistant';});
    }


    /**
     * Faculty constructor.
     * @param string|null $name
     * @param string|null $facultyCode
     */
    public function __construct($name = null, $facultyCode = null)
    {
        $this->name = $name;
        $this->facultyCode = $facultyCode;
        $this->roles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->courses = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sections = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Add role
     *
     * @param \AppBundle\Entity\Role $role
     *
     * @return Faculty
     */
    public function addRole(\AppBundle\Entity\Role $role)
    {
        $role->addFaculty($this);
        $this->roles[] = $role;
        return $this;
    }

    /**
     * Remove role
     *
     * @param \AppBundle\Entity\Role $role
     */
    public function removeRole(\AppBundle\Entity\Role $role)
    {
        $this->roles->removeElement($role);
    }

    /**
     * Get roles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Add course
     *
     * @param \AppBundle\Entity\Course $course
     *
     * @return Faculty
     */
    public function addCourse(\AppBundle\Entity\Course $course)
    {
        $this->courses[] = $course;
        return $this;
    }

    /**
     * Remove course
     *
     * @param \AppBundle\Entity\Course $course
     */
    public function removeCourse(\AppBundle\Entity\Course $course)
    {
        $this->courses->removeElement($course);
    }

    /**
     * Get courses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCourses()
    {
        return $this->courses;
    }

    /**
     * Add section
     *
     * @param \AppBundle\Entity\Section $section
     *
     * @return Faculty
     */
    public function addSection(\AppBundle\Entity\Section $section)
    {
        $this->sections[] = $section;

        return $this;
    }

    /**
     * Remove section
     *
     * @param \AppBundle\Entity\Section $section
     */
    public function removeSection(\AppBundle\Entity\Section $section)
    {
        $this->sections->removeElement($section);
    }

    /**
     * Get sections
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSections()
    {
        return $this->sections;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name.' '.$this->facultyCode;
    }

    /**
     * returns true if faculty has course
     *
     * @param Course $course
     * @return bool
     */
    public function hasCourse($course)
    {
        return $this->courses->contains($course);
    }

    /**
     * return true if faculty has the role
     * @param Role $role
     * @return bool
     */
    public function hasRole(Role $role){
        return $this->roles->contains($role);
    }

    /**
     * return true if faculty has the teacher
     * @param Teacher $teacher
     * @return bool
     */
    public function hasTeacher(Teacher $teacher){
        return $this->roles->contains($teacher);
    }

    /**
     * return true if faculty has the student
     * @param Student $student
     * @return bool
     */
    public function hasStudent(Student $student){
        return $this->roles->contains($student);
    }

    /**
     * @param string $activePeriod
     * @return \Doctrine\Common\Collections\ArrayCollection|\Doctrine\Common\Collections\Collection
     */
    public function getActiveCourses($activePeriod)
    {
        return $this->courses->filter(function($course)use($activePeriod){
            return $course->getClassCourses()->filter(function($classCourse) use ($activePeriod){
                    return $classCourse->getActivePeriod() == $activePeriod;
            })->count()>0;
        });
    }


}

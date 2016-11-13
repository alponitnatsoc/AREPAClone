<?php
/**
 * Created by PhpStorm.
 * User: erikaxu
 * Date: 14/09/16
 * Time: 12:05 PM
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;


/**
 * Class Course
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="course",
 *     uniqueConstraints={
 *          @UniqueConstraint(
 *              name="codeCourseUnique", columns={"course_code"}
 *          )
 *     })
 * @ORM\Entity
 */
Class Course
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_course",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idCourse;

    /**
     * @var string
     * @ORM\Column(name="academic_grade",type="string",length=20, nullable=true)
     */
    private $academicGrade;

    /**
     * @var string
     *
     * @ORM\Column(name="course_code",type="string", length=8, nullable=true)
     */
    private $courseCode;

    /**
     * @var integer
     *
     * @ORM\Column(name="credits",type="integer",nullable=true)
     */
    private $credits;

    /**
     * @var string
     *
     * @ORM\Column(name="name_course",type="string", length=150,nullable=true)
     */
    private $nameCourse;

    /**
     * @var string
     *
     * @ORM\Column(name="short_name_course",type="string", length=150,nullable=true)
     */
    private $shortNameCourse;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ClassCourse", mappedBy="courseCourse", cascade={"persist", "remove"})
     */
    private $classes;

    /**
     * @var string
     * @ORM\Column(name="component",type="string",length=20, nullable=true)
     */
    private $component;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\TeacherDictatesCourse", mappedBy="courseCourse", cascade={"persist", "remove"})
     */
    private $courseIsDictatedByTeachers;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\SectionHasCourse", mappedBy="courseCourse", cascade={"persist", "remove"})
     */
    private $courseHasSection;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\FacultyHasCourses", mappedBy="courseCourse", cascade={"persist", "remove"})
     */
    private $courseHasfaculty;

    /**
     * @var boolean
     * @ORM\Column(name="contribute_outcome",type="boolean", nullable=true)
     */
    private $contributeOutcome;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\CourseContributesOutcome", mappedBy="courseCourse", cascade={"persist", "remove"})
     */
    private $courseContributesOutcome;

    /**
     * @ORM\Column(name="created_at",type="datetime", nullable=true)
     */
    private $createdAt = null;

    /**
     * Get idCourse
     *
     * @return integer
     */
    public function getIdCourse()
    {
        return $this->idCourse;
    }

    /**
     * Set academicGrade
     *
     * @param string $academicGrade
     *
     * @return Course
     */
    public function setAcademicGrade($academicGrade)
    {
        $this->academicGrade = $academicGrade;

        return $this;
    }

    /**
     * Get academicGrade
     *
     * @return string
     */
    public function getAcademicGrade()
    {
        return $this->academicGrade;
    }

    /**
     * Set courseCode
     *
     * @param string $courseCode
     *
     * @return Course
     */
    public function setCourseCode($courseCode)
    {
        $this->courseCode = $courseCode;

        return $this;
    }

    /**
     * Get courseCode
     *
     * @return string
     */
    public function getCourseCode()
    {
        return $this->courseCode;
    }

    /**
     * Set credits
     *
     * @param integer $credits
     *
     * @return Course
     */
    public function setCredits($credits)
    {
        $this->credits = $credits;

        return $this;
    }

    /**
     * Get credits
     *
     * @return integer
     */
    public function getCredits()
    {
        return $this->credits;
    }

    /**
     * Set nameCourse
     *
     * @param string $nameCourse
     *
     * @return Course
     */
    public function setNameCourse($nameCourse)
    {
        $this->nameCourse = $nameCourse;

        return $this;
    }

    /**
     * Get nameCourse
     *
     * @return string
     */
    public function getNameCourse()
    {
        return $this->nameCourse;
    }

    /**
     * Set component
     *
     * @param string $component
     *
     * @return Course
     */
    public function setComponent($component)
    {
        $this->component = $component;

        return $this;
    }

    /**
     * Get component
     *
     * @return string
     */
    public function getComponent()
    {
        return $this->component;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Course
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

    /**
     * Add class
     *
     * @param \AppBundle\Entity\ClassCourse $class
     *
     * @return Course
     */
    public function addClass(\AppBundle\Entity\ClassCourse $class)
    {
        $class->setCourseCourse($this);
        $this->classes[] = $class;

        return $this;
    }

    /**
     * Remove class
     *
     * @param \AppBundle\Entity\ClassCourse $class
     */
    public function removeClass(\AppBundle\Entity\ClassCourse $class)
    {
        $this->classes->removeElement($class);
    }

    /**
     * Get classes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClasses()
    {
        return $this->classes;
    }

    /**
     * Add courseIsDictatedByTeacher
     *
     * @param \AppBundle\Entity\TeacherDictatesCourse $courseIsDictatedByTeacher
     *
     * @return Course
     */
    public function addCourseIsDictatedByTeacher(\AppBundle\Entity\TeacherDictatesCourse $courseIsDictatedByTeacher)
    {
        $this->courseIsDictatedByTeachers[] = $courseIsDictatedByTeacher;
        return $this;
    }

    /**
     * Remove courseIsDictatedByTeacher
     *
     * @param \AppBundle\Entity\TeacherDictatesCourse $courseIsDictatedByTeacher
     */
    public function removeCourseIsDictatedByTeacher(\AppBundle\Entity\TeacherDictatesCourse $courseIsDictatedByTeacher)
    {
        $this->courseIsDictatedByTeachers->removeElement($courseIsDictatedByTeacher);
    }

    /**
     * Get courseIsDictatedByTeachers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCourseIsDictatedByTeachers()
    {
        return $this->courseIsDictatedByTeachers;
    }

    /**
     * Add courseHasSection
     *
     * @param \AppBundle\Entity\SectionHasCourse $courseHasSection
     *
     * @return Course
     */
    public function addCourseHasSection(\AppBundle\Entity\SectionHasCourse $courseHasSection)
    {
        $this->courseHasSection[] = $courseHasSection;
        return $this;
    }

    /**
     * Remove courseHasSection
     *
     * @param \AppBundle\Entity\SectionHasCourse $courseHasSection
     */
    public function removeCourseHasSection(\AppBundle\Entity\SectionHasCourse $courseHasSection)
    {
        $this->courseHasSection->removeElement($courseHasSection);
    }

    /**
     * Get courseHasSection
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCourseHasSection()
    {
        return $this->courseHasSection;
    }

    /**
     * Add courseHasfaculty
     *
     * @param \AppBundle\Entity\FacultyHasCourses $courseHasfaculty
     *
     * @return Course
     */
    public function addCourseHasfaculty(\AppBundle\Entity\FacultyHasCourses $courseHasfaculty)
    {
        $this->courseHasfaculty[] = $courseHasfaculty;

        return $this;
    }

    /**
     * Remove courseHasfaculty
     *
     * @param \AppBundle\Entity\FacultyHasCourses $courseHasfaculty
     */
    public function removeCourseHasfaculty(\AppBundle\Entity\FacultyHasCourses $courseHasfaculty)
    {
        $this->courseHasfaculty->removeElement($courseHasfaculty);
    }

    /**
     * Get courseHasfaculty
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCourseHasfaculty()
    {
        return $this->courseHasfaculty;
    }

    /**
     * Set shortNameCourse
     *
     * @param string $shortNameCourse
     *
     * @return Course
     */
    public function setShortNameCourse($shortNameCourse)
    {
        $this->shortNameCourse = $shortNameCourse;

        return $this;
    }

    /**
     * Get shortNameCourse
     *
     * @return string
     */
    public function getShortNameCourse()
    {
        return $this->shortNameCourse;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->classes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->courseIsDictatedByTeachers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->courseHasSection = new \Doctrine\Common\Collections\ArrayCollection();
        $this->courseHasfaculty = new \Doctrine\Common\Collections\ArrayCollection();
        $this->courseContributesOutcome = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add courseContributesOutcome
     *
     * @param \AppBundle\Entity\CourseContributesOutcome $courseContributesOutcome
     *
     * @return Course
     */
    public function addCourseContributesOutcome(\AppBundle\Entity\CourseContributesOutcome $courseContributesOutcome)
    {
        $this->courseContributesOutcome[] = $courseContributesOutcome;

        return $this;
    }

    /**
     * Remove courseContributesOutcome
     *
     * @param \AppBundle\Entity\CourseContributesOutcome $courseContributesOutcome
     */
    public function removeCourseContributesOutcome(\AppBundle\Entity\CourseContributesOutcome $courseContributesOutcome)
    {
        $this->courseContributesOutcome->removeElement($courseContributesOutcome);
    }

    /**
     * Get courseContributesOutcome
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCourseContributesOutcome()
    {
        return $this->courseContributesOutcome;
    }

    /**
     * Set contributeOutcome
     *
     * @param boolean $contributeOutcome
     *
     * @return Course
     */
    public function setContributeOutcome($contributeOutcome)
    {
        $this->contributeOutcome = $contributeOutcome;

        return $this;
    }

    /**
     * Get contributeOutcome
     *
     * @return boolean
     */
    public function getContributeOutcome()
    {
        return $this->contributeOutcome;
    }
}

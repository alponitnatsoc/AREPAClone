<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 14/09/16
 * Time: 12:05 PM
 */
namespace AppBundle\Entity;

use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;


/**
 * Class Course
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="course")
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
     * @ORM\Column(name="course_code",type="string", length=8, unique=TRUE, nullable=true)
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
     * @var string
     * @ORM\Column(name="component",type="string",length=20, nullable=true)
     */
    private $component;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ClassCourse", mappedBy="course", cascade={"persist"})
     */
    private $classCourses;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\CourseContributesOutcome",mappedBy="course", cascade={"persist"})
     */
    private $courseContributesOutcome;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Faculty",mappedBy="courses")
     */
    private $faculties;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Teacher",mappedBy="courses", cascade={"persist"})
     */
    private $teachers;

    /**
     * @ORM\Column(name="created_at",type="datetime", nullable=true)
     */
    private $createdAt = null;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Section",inversedBy="courses", cascade={"persist"})
     * @ORM\JoinColumn(name="section_id", referencedColumnName="id_section")
     */
    private $section;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\EvaluationModel",mappedBy="course",cascade={"persist"})
     * @ORM\JoinColumn(name="evaluation_model_id", referencedColumnName="id_evaluation_model", unique=TRUE)
     */
    private $evaluationModel;

    /**
     * Course constructor.
     * @param string|null $academicGrade
     * @param string|null $courseCode
     * @param integer|null $credits
     * @param string|null $nameCourse
     * @param string|null $shortNameCourse
     * @param string|null $component
     * @param Section|null $section
     */
    public function __construct($academicGrade = null, $courseCode = null, $credits = null, $nameCourse = null, $shortNameCourse = null, $component = null,
                                Section $section = null)
    {
        $this->academicGrade = $academicGrade;
        $this->courseCode = $courseCode;
        $this->credits = $credits;
        $this->nameCourse = $nameCourse;
        $this->shortNameCourse = $shortNameCourse;
        $this->component = $component;
        $this->section = $section;
        $this->createdAt = new \DateTime();
        $this->classCourses = new \Doctrine\Common\Collections\ArrayCollection();
        $this->faculties = new \Doctrine\Common\Collections\ArrayCollection();
        $this->teachers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->courseContributesOutcome = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Add classCourse
     *
     * @param \AppBundle\Entity\ClassCourse $classCourse
     *
     * @return Course
     */
    public function addClassCourse(\AppBundle\Entity\ClassCourse $classCourse)
    {
        $this->classCourses[] = $classCourse;

        return $this;
    }

    /**
     * Remove classCourse
     *
     * @param \AppBundle\Entity\ClassCourse $classCourse
     */
    public function removeClassCourse(\AppBundle\Entity\ClassCourse $classCourse)
    {
        $this->classCourses->removeElement($classCourse);
    }

    /**
     * Get classCourses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClassCourses()
    {
        return $this->classCourses;
    }

    /**
     * Add faculty
     *
     * @param \AppBundle\Entity\Faculty $faculty
     *
     * @return Course
     */
    public function addFaculty(\AppBundle\Entity\Faculty $faculty)
    {
        $this->faculties[] = $faculty;

        return $this;
    }

    /**
     * Remove faculty
     *
     * @param \AppBundle\Entity\Faculty $faculty
     */
    public function removeFaculty(\AppBundle\Entity\Faculty $faculty)
    {
        $this->faculties->removeElement($faculty);
    }

    /**
     * Get faculties
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFaculties()
    {
        return $this->faculties;
    }

    /**
     * Add teacher
     *
     * @param \AppBundle\Entity\Teacher $teacher
     *
     * @return Course
     */
    public function addTeacher(\AppBundle\Entity\Teacher $teacher)
    {
        $this->teachers[] = $teacher;

        return $this;
    }

    /**
     * Remove teacher
     *
     * @param \AppBundle\Entity\Teacher $teacher
     */
    public function removeTeacher(\AppBundle\Entity\Teacher $teacher)
    {
        $this->teachers->removeElement($teacher);
    }

    /**
     * Get teachers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTeachers()
    {
        return $this->teachers;
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
     * Set section
     *
     * @param \AppBundle\Entity\Section $section
     *
     * @return Course
     */
    public function setSection(\AppBundle\Entity\Section $section = null)
    {
        $this->section = $section;

        return $this;
    }

    /**
     * Get section
     *
     * @return \AppBundle\Entity\Section
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * Set evaluationModel
     *
     * @param \AppBundle\Entity\EvaluationModel $evaluationModel
     *
     * @return Course
     */
    public function setEvaluationModel(\AppBundle\Entity\EvaluationModel $evaluationModel = null)
    {
        $this->evaluationModel = $evaluationModel;

        return $this;
    }

    /**
     * Get evaluationModel
     *
     * @return \AppBundle\Entity\EvaluationModel
     */
    public function getEvaluationModel()
    {
        return $this->evaluationModel;
    }
}

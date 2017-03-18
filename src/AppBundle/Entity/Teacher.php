<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 13/09/16
 * Time: 10:14 PM
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class Student
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 */
class Teacher extends Role
{
    /**
     * @var string
     *
     * @ORM\Column(name="code_teacher",type="string", unique=TRUE, nullable=true)
     */
    private $teacherCode;

    /**
     * @ORM\Column(name="created_at",type="datetime", nullable=true)
     */
    private $createdAt = null;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Course", inversedBy="teachers", cascade={"persist"})
     * @ORM\JoinTable(name="teacher_dictates_course",
     *      joinColumns={@ORM\JoinColumn(name="role_id",referencedColumnName="id_role")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="course_id",referencedColumnName="id_course")}
     *     )
     */
    private $courses;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Section", inversedBy="sectionChief", cascade={"persist"})
     * @ORM\Column(name="section", nullable=TRUE)
     */
    private $section;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\EvaluationModel",mappedBy="owner", cascade={"persist"})
     */
    private $evaluationModels;

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getClass()." ".$this->getTeacherCode();
    }

    /**
     * Student constructor.
     * @param Person|null $person
     * @param string $teacherCode
     * @param \DateTime $createdAt
     */
    public function __construct(Person $person = null, $teacherCode = null, $createdAt = null)
    {
        parent::__construct($person);
        $this->teacherCode = $teacherCode;
        $this->createdAt = $createdAt;
        $this->courses = new \Doctrine\Common\Collections\ArrayCollection();
        $this->evaluationModels = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * get class
     * returns the name of the class
     * @return string
     */
    public function getClass(){
        $path = explode('\\', __CLASS__);
        return array_pop($path);
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

    /**
     * Add course
     *
     * @param \AppBundle\Entity\Course $course
     *
     * @return Teacher
     */
    public function addCourse(\AppBundle\Entity\Course $course)
    {
        $course->addTeacher($this);
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
        $course->removeTeacher($this);
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
     * Set section
     *
     * @param string $section
     *
     * @return Teacher
     */
    public function setSection($section)
    {
        $this->section = $section;

        return $this;
    }

    /**
     * Get section
     *
     * @return string
     */
    public function getSection()
    {
        return $this->section;
    }

    public function isSectionChief()
    {
        return ($this->section != null)? true : false;
    }

    /**
     * Add evaluationModel
     *
     * @param \AppBundle\Entity\EvaluationModel $evaluationModel
     *
     * @return Teacher
     */
    public function addEvaluationModel(\AppBundle\Entity\EvaluationModel $evaluationModel)
    {
        $evaluationModel->setOwner($this);
        $this->evaluationModels[] = $evaluationModel;
        return $this;
    }

    /**
     * Remove evaluationModel
     *
     * @param \AppBundle\Entity\EvaluationModel $evaluationModel
     */
    public function removeEvaluationModel(\AppBundle\Entity\EvaluationModel $evaluationModel)
    {
        $this->evaluationModels->removeElement($evaluationModel);
    }

    /**
     * Get evaluationModels
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvaluationModels()
    {
        return $this->evaluationModels;
    }
}

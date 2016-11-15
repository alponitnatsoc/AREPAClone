<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 16/09/16
 * Time: 10:53 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class Rubric
 * @package AppBundle\Entity
 * @ORM\Table(name="rubric")
 * @ORM\Entity
 */
class Rubric
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_rubric",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idRubric;

    /**
     * @var string
     * @ORM\Column(name="name",type="string")
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="period", type="string", length=7)
     */
    private $period='';

    /**
     * @var TeacherDictatesCourse
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TeacherDictatesCourse", inversedBy="rubrics")
     * @ORM\JoinColumn(name="teacher_dictates_course_id", referencedColumnName="id_teacher_dictates_course")
     */
    private $teacherDictatesCourse;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\RubricHasAssessmentTool", mappedBy="rubricRubric", cascade={"persist","remove"})
     */
    private $rubricHasAssessmentTools;

    /**
     * @var ClassCourse
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ClassCourse",inversedBy="rubrics")
     * @ORM\JoinColumn(name="class_course_id", referencedColumnName="id_class")
     */
    private $classCourseClassCourse;

    /**
     * @var Course
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Course",inversedBy="rubrics")
     * @ORM\JoinColumn(name="course_id", referencedColumnName="id_course")
     */
    private $courseCourse;

    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->rubricHasAssessmentTools = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get idRubric
     *
     * @return integer
     */
    public function getIdRubric()
    {
        return $this->idRubric;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Rubric
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
     * Set period
     *
     * @param string $period
     *
     * @return Rubric
     */
    public function setPeriod($period)
    {
        $this->period = $period;

        return $this;
    }

    /**
     * Get period
     *
     * @return string
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * Set teacherDictatesCourse
     *
     * @param \AppBundle\Entity\TeacherDictatesCourse $teacherDictatesCourse
     *
     * @return Rubric
     */
    public function setTeacherDictatesCourse(\AppBundle\Entity\TeacherDictatesCourse $teacherDictatesCourse = null)
    {
        $this->teacherDictatesCourse = $teacherDictatesCourse;

        return $this;
    }

    /**
     * Get teacherDictatesCourse
     *
     * @return \AppBundle\Entity\TeacherDictatesCourse
     */
    public function getTeacherDictatesCourse()
    {
        return $this->teacherDictatesCourse;
    }

    /**
     * Add rubricHasAssessmentTool
     *
     * @param \AppBundle\Entity\RubricHasAssessmentTool $rubricHasAssessmentTool
     *
     * @return Rubric
     */
    public function addRubricHasAssessmentTool(\AppBundle\Entity\RubricHasAssessmentTool $rubricHasAssessmentTool)
    {
        $this->rubricHasAssessmentTools[] = $rubricHasAssessmentTool;

        return $this;
    }

    /**
     * Remove rubricHasAssessmentTool
     *
     * @param \AppBundle\Entity\RubricHasAssessmentTool $rubricHasAssessmentTool
     */
    public function removeRubricHasAssessmentTool(\AppBundle\Entity\RubricHasAssessmentTool $rubricHasAssessmentTool)
    {
        $this->rubricHasAssessmentTools->removeElement($rubricHasAssessmentTool);
    }

    /**
     * Get rubricHasAssessmentTools
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRubricHasAssessmentTools()
    {
        return $this->rubricHasAssessmentTools;
    }

    /**
     * Set classCourseClassCourse
     *
     * @param \AppBundle\Entity\ClassCourse $classCourseClassCourse
     *
     * @return Rubric
     */
    public function setClassCourseClassCourse(\AppBundle\Entity\ClassCourse $classCourseClassCourse = null)
    {
        $this->classCourseClassCourse = $classCourseClassCourse;

        return $this;
    }

    /**
     * Get classCourseClassCourse
     *
     * @return \AppBundle\Entity\ClassCourse
     */
    public function getClassCourseClassCourse()
    {
        return $this->classCourseClassCourse;
    }

    /**
     * Set courseCourse
     *
     * @param \AppBundle\Entity\Course $courseCourse
     *
     * @return Rubric
     */
    public function setCourseCourse(\AppBundle\Entity\Course $courseCourse = null)
    {
        $this->courseCourse = $courseCourse;

        return $this;
    }

    /**
     * Get courseCourse
     *
     * @return \AppBundle\Entity\Course
     */
    public function getCourseCourse()
    {
        return $this->courseCourse;
    }
}

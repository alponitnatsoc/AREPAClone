<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 14/09/16
 * Time: 07:03 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class TeacherHasCourse
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="teacher_has_course",
 *     indexes={@ORM\Index(name="fk_course_has_teachers",columns={"course_id_course"}),
 *              @ORM\Index(name="fk_teacher_has_courses",columns={"teacher_id_teacher"})
 *     })
 * @ORM\Entity
 */
class TeacherDictatesCourse
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_teacher_dictates_course",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idTeacherDicatesCourse;

    /**
     * @var Teacher
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Teacher",inversedBy="teacherDictatesCourses")
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="teacher_id_teacher",referencedColumnName="id_teacher")
     * })
     */
    private $teacherTeacher;

    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Course",inversedBy="courseIsDictatedByTeachers")
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="course_id_course",referencedColumnName="id_course")
     * })
     */
    private $courseCourse;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\TeacherDictatesClassCourse", mappedBy="teacherDictatesCourse")
     */
    private $classes;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Rubric",mappedBy="teacherDictatesCourse")
     */
    private $rubrics;

    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->classes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->rubrics = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get idTeacherDicatesCourse
     *
     * @return integer
     */
    public function getIdTeacherDicatesCourse()
    {
        return $this->idTeacherDicatesCourse;
    }

    /**
     * Set teacherTeacher
     *
     * @param \AppBundle\Entity\Teacher $teacherTeacher
     *
     * @return TeacherDictatesCourse
     */
    public function setTeacherTeacher(\AppBundle\Entity\Teacher $teacherTeacher = null)
    {
        $this->teacherTeacher = $teacherTeacher;

        return $this;
    }

    /**
     * Get teacherTeacher
     *
     * @return \AppBundle\Entity\Teacher
     */
    public function getTeacherTeacher()
    {
        return $this->teacherTeacher;
    }

    /**
     * Set courseCourse
     *
     * @param \AppBundle\Entity\Course $courseCourse
     *
     * @return TeacherDictatesCourse
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

    /**
     * Add class
     *
     * @param \AppBundle\Entity\TeacherDictatesClassCourse $class
     *
     * @return TeacherDictatesCourse
     */
    public function addClass(\AppBundle\Entity\TeacherDictatesClassCourse $class)
    {
        $this->classes[] = $class;

        return $this;
    }

    /**
     * Remove class
     *
     * @param \AppBundle\Entity\TeacherDictatesClassCourse $class
     */
    public function removeClass(\AppBundle\Entity\TeacherDictatesClassCourse $class)
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
     * Add rubric
     *
     * @param \AppBundle\Entity\Rubric $rubric
     *
     * @return TeacherDictatesCourse
     */
    public function addRubric(\AppBundle\Entity\Rubric $rubric)
    {
        $this->rubrics[] = $rubric;

        return $this;
    }

    /**
     * Remove rubric
     *
     * @param \AppBundle\Entity\Rubric $rubric
     */
    public function removeRubric(\AppBundle\Entity\Rubric $rubric)
    {
        $this->rubrics->removeElement($rubric);
    }

    /**
     * Get rubrics
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRubrics()
    {
        return $this->rubrics;
    }
}

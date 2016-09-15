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
 * Class StudentAssistClasses
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="student_assist_classes",
 *     indexes={@ORM\Index(name="fk_student_assist_classes",columns={"student_id_student"}),
 *              @ORM\Index(name="fk_class_has_students",columns={"class_id_class"})
 *     })
 * @ORM\Entity
 */
class StudentAssistClass
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_student_assist_class",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idStudentAssistClass;

    /**
     * @var Student
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Student",inversedBy="studentAssistClasses")
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="student_id_student",referencedColumnName="id_student")
     * })
     */
    private $studentStudent;

    /**
     * @var ClassCourse
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ClassCourse",inversedBy="classHasStudents")
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="class_id_class",referencedColumnName="id_class")
     * })
     */
    private $classCourseClassCourse;

    /**
     * @var float
     * @ORM\Column(type="float", )
     */
    private $defGrade = 0.0;

//    private $assesmentTools;


    /**
     * Get idStudentAssistClass
     *
     * @return integer
     */
    public function getIdStudentAssistClass()
    {
        return $this->idStudentAssistClass;
    }

    /**
     * Set defGrade
     *
     * @param float $defGrade
     *
     * @return StudentAssistClass
     */
    public function setDefGrade($defGrade)
    {
        $this->defGrade = $defGrade;

        return $this;
    }

    /**
     * Get defGrade
     *
     * @return float
     */
    public function getDefGrade()
    {
        return $this->defGrade;
    }

    /**
     * Set studentStudent
     *
     * @param \AppBundle\Entity\Student $studentStudent
     *
     * @return StudentAssistClass
     */
    public function setStudentStudent(\AppBundle\Entity\Student $studentStudent = null)
    {
        $this->studentStudent = $studentStudent;

        return $this;
    }

    /**
     * Get studentStudent
     *
     * @return \AppBundle\Entity\Student
     */
    public function getStudentStudent()
    {
        return $this->studentStudent;
    }

    /**
     * Set classCourseClassCourse
     *
     * @param \AppBundle\Entity\ClassCourse $classCourseClassCourse
     *
     * @return StudentAssistClass
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
}

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
 * Class TeacherHasClass
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="teacher_has_class",
 *     indexes={@ORM\Index(name="fk_class_has_teachers",columns={"class_id"}),
 *              @ORM\Index(name="fk_teacher_has_classes",columns={"teacher_dictates_course_id"})
 *     })
 * @ORM\Entity
 */
class TeacherDictatesClassCourse
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_teacher_dictates_class",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idTeacherDictatesClass;

    /**
     * @var Teacher
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TeacherDictatesCourse",inversedBy="classes", cascade={"persist"})
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="teacher_dictates_course_id",referencedColumnName="id_teacher_dictates_course")
     * })
     */
    private $teacherDictatesCourse;

    /**
     * @var ClassCourse
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ClassCourse",inversedBy="classHasTeacher",cascade={"persist"})
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="class_id",referencedColumnName="id_class")
     * })
     */
    private $classClass;

    /**
     * Get idTeacherDictatesClass
     *
     * @return integer
     */
    public function getIdTeacherDictatesClass()
    {
        return $this->idTeacherDictatesClass;
    }

    /**
     * Set teacherDictatesCourse
     *
     * @param \AppBundle\Entity\TeacherDictatesCourse $teacherDictatesCourse
     *
     * @return TeacherDictatesClassCourse
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
     * Set classClass
     *
     * @param \AppBundle\Entity\ClassCourse $classClass
     *
     * @return TeacherDictatesClassCourse
     */
    public function setClassClass(\AppBundle\Entity\ClassCourse $classClass = null)
    {
        $this->classClass = $classClass;

        return $this;
    }

    /**
     * Get classClass
     *
     * @return \AppBundle\Entity\ClassCourse
     */
    public function getClassClass()
    {
        return $this->classClass;
    }
}

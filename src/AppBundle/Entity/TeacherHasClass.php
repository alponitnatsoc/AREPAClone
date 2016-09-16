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
 *     indexes={@ORM\Index(name="fk_class_has_teachers",columns={"class_id_class"}),
 *              @ORM\Index(name="fk_teacher_has_classes",columns={"teacher_id_teacher"})
 *     })
 * @ORM\Entity
 */
class TeacherHasClass
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_teacher_has_class",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idTeacherHasClass;

    /**
     * @var ClassCourse
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ClassCourse",inversedBy="classHasTeachers")
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="class_course_id_class_course",referencedColumnName="id_class")
     * })
     */
    private $classCourseClassCourse;

    /**
     * @var ClassCourse
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Teacher",inversedBy="teacherHasClasses")
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="teacher_id_teacher",referencedColumnName="id_teacher")
     * })
     */
    private $teacherTeacher;

    /**
     * @var float
     * @ORM\Column(type="float", )
     */
    private $defGrade = 0.0;

//    private $assesmentTools;
}

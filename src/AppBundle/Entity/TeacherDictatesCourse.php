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
 *     indexes={@ORM\Index(name="fk_class_has_teachers",columns={"course_id_course"}),
 *              @ORM\Index(name="fk_teacher_has_classes",columns={"teacher_id_teacher"})
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
     * @var ClassCourse
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Course",inversedBy="courseIsDictatedByTeachers")
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="course_id_course",referencedColumnName="id_course")
     * })
     */
    private $courseCourse;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Rubric",mappedBy="teacherDictatesCourse")
     */
    private $rubrics;

}

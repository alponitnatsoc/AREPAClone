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
 *     indexes={@ORM\Index(name="fk_student_assist_classes",columns={student_id_studen}),
 *              @ORM\Index(name="fk_class_has_students",columns={class_id_class})
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
     *     @ORM\JoinColumn(name="sudent_id_student",referencedColumnName="id_student")
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

}
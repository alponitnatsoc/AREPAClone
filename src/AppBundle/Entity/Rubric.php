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
     * @ORM\Column(name="period", type="string", length=7)
     */
    private $period='';

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TeacherDictatesCourse", inversedBy="rubrics")
     * @ORM\JoinColumn(name="teacher_dictates_course_id", referencedColumnName="id_teacher_dictates_course")
     */
    private $teacherDictatesCourse;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\RubricHasAssessmentTool", mappedBy="rubricRubric")
     */
    private $rubricHasAssessmentTools;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ClassCourse",inversedBy="rubrics")
     * @ORM\JoinColumn(name="class_course_id", referencedColumnName="id_class")
     */
    private $classCourseClassCourse;

}
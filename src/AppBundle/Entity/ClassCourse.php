<?php
/**
 * Created by PhpStorm.
 * User: erikaxu
 * Date: 14/09/16
 * Time: 12:22 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class ClassCourse
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="class_course",
 *     uniqueConstraints={
 *          @UniqueConstraint(
 *              name="codeClassUnique", columns={"class_code"}
 *          )
 *     })
 * @ORM\Entity
 */
class ClassCourse
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id_class",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idclass;

    /**
     * @var string
     *
     * @ORM\Column(name="class_code", type="string", length=8, nullable=true)
     */
    private $classCode;

    /**
     * @var string
     *
     * @ORM\Column(name="ciclolectivo",type="string", length=7,nullable=true)
     */
    private $ciclolectivo;

    /**
     * @var Course
     *
     * @ORM\ManyToOne(targetEntity="Course", inversedBy="classes")
     * @ORM\JoinColumns({@ORM\JoinColumn(name="course_id_course", referencedColumnName="id_course")})
     */
    private $courseCourse;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\StudentAssistClass",mappedBy="classCourseClassCourse",cascade={"persist"})
     */
    private $classHasStudents;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Rubric", mappedBy="classCourseClassCourse", cascade={"persist"})
     */
    private $rubrics;

}

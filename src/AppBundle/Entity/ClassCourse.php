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


    // ...
    /**
     * @var Course
     * @ORM\ManyToOne(targetEntity="Course", inversedBy="classes")
     * @ORM\JoinColumns({@ORM\JoinColumn(name="course_id_course", referencedColumnName="id_course")})
     */
    private $courseCourse;

    /**
     * Get idclass
     *
     * @return integer
     */
    public function getIdclass()
    {
        return $this->idclass;
    }

    /**
     * Set classCode
     *
     * @param string $classCode
     *
     * @return ClassCourse
     */
    public function setClassCode($classCode)
    {
        $this->classCode = $classCode;

        return $this;
    }

    /**
     * Get classCode
     *
     * @return string
     */
    public function getClassCode()
    {
        return $this->classCode;
    }

    /**
     * Set ciclolectivo
     *
     * @param string $ciclolectivo
     *
     * @return ClassCourse
     */
    public function setCiclolectivo($ciclolectivo)
    {
        $this->ciclolectivo = $ciclolectivo;

        return $this;
    }

    /**
     * Get ciclolectivo
     *
     * @return string
     */
    public function getCiclolectivo()
    {
        return $this->ciclolectivo;
    }

    /**
     * Set courseCourse
     *
     * @param \AppBundle\Entity\Course $courseCourse
     *
     * @return ClassCourse
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

<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 15/03/17
 * Time: 01:59 PM
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class DefGrade
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 */
class DefGrade extends Grade
{
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ClassCourse")
     * @ORM\JoinColumn(name="class_course_id",referencedColumnName="id_class_course")
     */
    private $classCourse;

    /**
     * get class
     * returns the name of the class
     * @return string
     */
    public function getClass(){
        $path = explode('\\', __CLASS__);
        return array_pop($path);
    }

    /**
     * DefGrade constructor.
     * @param Student|null $student
     * @param ClassCourse|null $classCourse
     * @param float|null $value
     */
    public function __construct(Student $student = null, ClassCourse $classCourse = null, $value = null)
    {
        $this->student = $student;
        $this->classCourse = $classCourse;
        $this->value = $value;
    }

    /**
     * Set course
     *
     * @param \AppBundle\Entity\ClassCourse $classCourse
     *
     * @return DefGrade
     */
    public function setClassCourse(\AppBundle\Entity\ClassCourse $classCourse = null)
    {
        $this->classCourse = $classCourse;

        return $this;
    }

    /**
     * Get course
     *
     * @return \AppBundle\Entity\ClassCourse
     */
    public function getClassCourse()
    {
        return $this->classCourse;
    }
}

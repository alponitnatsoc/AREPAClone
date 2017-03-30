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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Course")
     * @ORM\JoinColumn(name="course_id",referencedColumnName="id_course")
     */
    private $course;

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
     * @param Course|null $course
     * @param float|null $value
     */
    public function __construct(Student $student = null, Course $course = null, $value = null)
    {
        $this->student = $student;
        $this->course = $course;
        $this->value = $value;
    }

    /**
     * Set course
     *
     * @param \AppBundle\Entity\Course $course
     *
     * @return DefGrade
     */
    public function setCourse(\AppBundle\Entity\Course $course = null)
    {
        $this->course = $course;

        return $this;
    }

    /**
     * Get course
     *
     * @return \AppBundle\Entity\Course
     */
    public function getCourse()
    {
        return $this->course;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 13/09/16
 * Time: 09:55 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Student
 * @package AppBundle\Entity
 *
 * @ORM\Entity()
 */

class Student extends Role
{
    /**
     * @var string
     *
     * @ORM\Column(name="code_student",type="string",unique=TRUE, nullable=true)
     */
    private $studentCode;

    /**
     * @var float
     *
     * @ORM\Column(name="grade_point_average",type="float")
     */
    private $averageGrade=0.0;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $approvedCredits=0;

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getClass()." ".$this->getStudentCode();
    }

    /**
     * Student constructor.
     * @param Person|null $person
     * @param string $studentCode
     * @param float $averageGrade
     * @param int $approvedCredits
     */
    public function __construct(Person $person = null, $studentCode = null, $averageGrade = 0.0, $approvedCredits = 0)
    {
        parent::__construct($person);
        $this->averageGrade = $averageGrade;
        $this->approvedCredits = $approvedCredits;
        $this->studentCode = $studentCode;
    }

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
     * Set studentCode
     *
     * @param string $studentCode
     *
     * @return Student
     */
    public function setStudentCode($studentCode)
    {
        $this->studentCode = $studentCode;

        return $this;
    }

    /**
     * Get studentCode
     *
     * @return string
     */
    public function getStudentCode()
    {
        return $this->studentCode;
    }

    /**
     * Set averageGrade
     *
     * @param float $averageGrade
     *
     * @return Student
     */
    public function setAverageGrade($averageGrade)
    {
        $this->averageGrade = $averageGrade;

        return $this;
    }

    /**
     * Get averageGrade
     *
     * @return float
     */
    public function getAverageGrade()
    {
        return $this->averageGrade;
    }

    /**
     * Set approvedCredits
     *
     * @param integer $approvedCredits
     *
     * @return Student
     */
    public function setApprovedCredits($approvedCredits)
    {
        $this->approvedCredits = $approvedCredits;

        return $this;
    }

    /**
     * Get approvedCredits
     *
     * @return integer
     */
    public function getApprovedCredits()
    {
        return $this->approvedCredits;
    }
}

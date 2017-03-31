<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 13/09/16
 * Time: 09:55 PM
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\Criteria;
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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Grade",mappedBy="student", cascade={"persist"})
     */
    private $grades;

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
        $this->grades = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * Add grade
     *
     * @param \AppBundle\Entity\Grade $grade
     *
     * @return Student
     */
    public function addGrade(\AppBundle\Entity\Grade $grade)
    {
        $grade->setStudent($this);
        $this->grades[] = $grade;
        return $this;
    }

    /**
     * Remove grade
     *
     * @param \AppBundle\Entity\Grade $grade
     */
    public function removeGrade(\AppBundle\Entity\Grade $grade)
    {
        $this->grades->removeElement($grade);
    }

    /**
     * Get grades
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGrades()
    {
        return $this->grades;
    }

    public function getDefGrades()
    {
        return ($this->grades->filter(function($grade){return $grade->getClass()=='DefGrade';})->count>0)?$this->grades->filter(function($grade){return $grade->getClass()=='DefGrade';}):null;
    }
}

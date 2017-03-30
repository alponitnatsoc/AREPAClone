<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 15/03/17
 * Time: 01:59 PM
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class Grade
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="grade")
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="class", type="string")
 * @ORM\DiscriminatorMap({"grade"="Grade","def_grade" = "DefGrade"})
 */
class Grade
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_grade",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $idGrade;

    /**
     * @var float
     * @ORM\Column(name="value", type="float", nullable=TRUE)
     */
    protected $value;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Student", inversedBy="grades", cascade={"persist"})
     * @ORM\JoinColumn(name="role_id",referencedColumnName="id_role", nullable=TRUE)
     */
    protected $student;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AssessmentComponent", inversedBy="grades", cascade={"persist"})
     * @ORM\JoinColumn(name="assessment_component_id",referencedColumnName="id_assessment_component", nullable=TRUE)
     */
    protected $assessmentComponent;

    /**
     * Get idGrade
     *
     * @return integer
     */
    public function getIdGrade()
    {
        return $this->idGrade;
    }

    /**
     * Set value
     *
     * @param float $value
     *
     * @return Grade
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set student
     *
     * @param \AppBundle\Entity\Student $student
     *
     * @return Grade
     */
    public function setStudent(\AppBundle\Entity\Student $student = null)
    {
        $this->student = $student;

        return $this;
    }

    /**
     * Get student
     *
     * @return \AppBundle\Entity\Student
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * Set assessmentComponent
     *
     * @param \AppBundle\Entity\AssessmentComponent $assessmentComponent
     *
     * @return Grade
     */
    public function setAssessmentComponent(\AppBundle\Entity\AssessmentComponent $assessmentComponent = null)
    {
        $this->assessmentComponent = $assessmentComponent;

        return $this;
    }

    /**
     * Get assessmentComponent
     *
     * @return \AppBundle\Entity\AssessmentComponent
     */
    public function getAssessmentComponent()
    {
        return $this->assessmentComponent;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 24/09/16
 * Time: 05:46 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class CourseContributesOutcome
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="course_contributes_outcome")
 * @ORM\Entity
 */
class CourseContributesOutcome
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_course_contributes_outcome",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idCourseContributesOutcome;

    /**
     * @var integer
     * @ORM\Column(name="bloom_level",type="integer", length=1)
     */
    private $bloomLevel;

    /**
     * @var string
     * @ORM\Column(name="active_period",type="string",length=7, nullable=true)
     */
    private $activePeriod;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Course", inversedBy="courseContributesOutcome", cascade={"persist"})
     * @ORM\JoinColumn(name="course_id", referencedColumnName="id_course")
     */
    private $course;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Outcome", inversedBy="courseContributesOutcome", cascade={"persist"})
     * @ORM\JoinColumn(name="outcome_id", referencedColumnName="id_outcome")
     */
    private $outcome;

    /**
     * @var float
     *
     * @ORM\Column(name="ex_student_outcome_value",type="float",nullable=true)
     */
    private $exStudentOutcomeValue;

    /**
     * @var float
     *
     * @ORM\Column(name="internal_outcome_value",type="float",nullable=true)
     */
    private $internalOutcomeValue;

    /**
     * @var float
     *
     * @ORM\Column(name="ex_student_percentage_value",type="float",nullable=true)
     */
    private $exStudentPercentageValue;

    /**
     * @var float
     *
     * @ORM\Column(name="total_value",type="float",nullable=true)
     */
    private $totalValue;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\AssessmentComponent", mappedBy="courseContributeOutcomes",cascade={"persist"})
     */
    private $assessmentComponents;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->assessmentComponents = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get idCourseContributesOutcome
     *
     * @return integer
     */
    public function getIdCourseContributesOutcome()
    {
        return $this->idCourseContributesOutcome;
    }

    /**
     * Set bloomLevel
     *
     * @param integer $bloomLevel
     *
     * @return CourseContributesOutcome
     */
    public function setBloomLevel($bloomLevel)
    {
        $this->bloomLevel = $bloomLevel;

        return $this;
    }

    /**
     * Get bloomLevel
     *
     * @return integer
     */
    public function getBloomLevel()
    {
        return $this->bloomLevel;
    }

    /**
     * Set activePeriod
     *
     * @param string $activePeriod
     *
     * @return CourseContributesOutcome
     */
    public function setActivePeriod($activePeriod)
    {
        $this->activePeriod = $activePeriod;

        return $this;
    }

    /**
     * Get activePeriod
     *
     * @return string
     */
    public function getActivePeriod()
    {
        return $this->activePeriod;
    }

    /**
     * Set exStudentOutcomeValue
     *
     * @param float $exStudentOutcomeValue
     *
     * @return CourseContributesOutcome
     */
    public function setExStudentOutcomeValue($exStudentOutcomeValue)
    {
        $this->exStudentOutcomeValue = $exStudentOutcomeValue;

        return $this;
    }

    /**
     * Get exStudentOutcomeValue
     *
     * @return float
     */
    public function getExStudentOutcomeValue()
    {
        return $this->exStudentOutcomeValue;
    }

    /**
     * Set internalOutcomeValue
     *
     * @param float $internalOutcomeValue
     *
     * @return CourseContributesOutcome
     */
    public function setInternalOutcomeValue($internalOutcomeValue)
    {
        $this->internalOutcomeValue = $internalOutcomeValue;

        return $this;
    }

    /**
     * Get internalOutcomeValue
     *
     * @return float
     */
    public function getInternalOutcomeValue()
    {
        return $this->internalOutcomeValue;
    }

    /**
     * Set exStudentPercentageValue
     *
     * @param float $exStudentPercentageValue
     *
     * @return CourseContributesOutcome
     */
    public function setExStudentPercentageValue($exStudentPercentageValue)
    {
        $this->exStudentPercentageValue = $exStudentPercentageValue;

        return $this;
    }

    /**
     * Get exStudentPercentageValue
     *
     * @return float
     */
    public function getExStudentPercentageValue()
    {
        return $this->exStudentPercentageValue;
    }

    /**
     * Set totalValue
     *
     * @param float $totalValue
     *
     * @return CourseContributesOutcome
     */
    public function setTotalValue($totalValue)
    {
        $this->totalValue = $totalValue;

        return $this;
    }

    /**
     * Get totalValue
     *
     * @return float
     */
    public function getTotalValue()
    {
        return $this->totalValue;
    }

    /**
     * Set course
     *
     * @param \AppBundle\Entity\Course $course
     *
     * @return CourseContributesOutcome
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

    /**
     * Set outcome
     *
     * @param \AppBundle\Entity\Outcome $outcome
     *
     * @return CourseContributesOutcome
     */
    public function setOutcome(\AppBundle\Entity\Outcome $outcome = null)
    {
        $this->outcome = $outcome;

        return $this;
    }

    /**
     * Get outcome
     *
     * @return \AppBundle\Entity\Outcome
     */
    public function getOutcome()
    {
        return $this->outcome;
    }

    /**
     * Add assessmentComponent
     *
     * @param \AppBundle\Entity\AssessmentComponent $assessmentComponent
     *
     * @return CourseContributesOutcome
     */
    public function addAssessmentComponent(\AppBundle\Entity\AssessmentComponent $assessmentComponent)
    {
        $this->assessmentComponents[] = $assessmentComponent;

        return $this;
    }

    /**
     * Remove assessmentComponent
     *
     * @param \AppBundle\Entity\AssessmentComponent $assessmentComponent
     */
    public function removeAssessmentComponent(\AppBundle\Entity\AssessmentComponent $assessmentComponent)
    {
        $this->assessmentComponents->removeElement($assessmentComponent);
    }

    /**
     * Get assessmentComponents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAssessmentComponents()
    {
        return $this->assessmentComponents;
    }
}

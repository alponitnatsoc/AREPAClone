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
     * @var string
     * @ORM\Column(name="below_standard_spanish",type="text",nullable=true,length=20000)
     */
    private $belowStandardSpanish;

    /**
     * @var string
     * @ORM\Column(name="competent_spanish",type="text",nullable=true,length=20000)
     */
    private $competentSpanish;

    /**
     * @var string
     * @ORM\Column(name="exemplary_spanish",type="text",nullable=true,length=20000)
     */
    private $exemplarySpanish;

    /**
     * @var string
     * @ORM\Column(name="below_standard_english",type="text",nullable=true,length=20000)
     */
    private $belowStandardEnglish;

    /**
     * @var string
     * @ORM\Column(name="competent_english",type="text",nullable=true,length=20000)
     */
    private $competentEnglish;

    /**
     * @var string
     * @ORM\Column(name="exemplary_english",type="text",nullable=true,length=20000)
     */
    private $exemplaryEnglish;

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
     * Set belowStandardSpanish
     *
     * @param string $belowStandardSpanish
     *
     * @return CourseContributesOutcome
     */
    public function setBelowStandardSpanish($belowStandardSpanish)
    {
        $this->belowStandardSpanish = $belowStandardSpanish;

        return $this;
    }

    /**
     * Get belowStandardSpanish
     *
     * @return string
     */
    public function getBelowStandardSpanish()
    {
        return $this->belowStandardSpanish;
    }

    /**
     * Set competentSpanish
     *
     * @param string $competentSpanish
     *
     * @return CourseContributesOutcome
     */
    public function setCompetentSpanish($competentSpanish)
    {
        $this->competentSpanish = $competentSpanish;

        return $this;
    }

    /**
     * Get competentSpanish
     *
     * @return string
     */
    public function getCompetentSpanish()
    {
        return $this->competentSpanish;
    }

    /**
     * Set exemplarySpanish
     *
     * @param string $exemplarySpanish
     *
     * @return CourseContributesOutcome
     */
    public function setExemplarySpanish($exemplarySpanish)
    {
        $this->exemplarySpanish = $exemplarySpanish;

        return $this;
    }

    /**
     * Get exemplarySpanish
     *
     * @return string
     */
    public function getExemplarySpanish()
    {
        return $this->exemplarySpanish;
    }

    /**
     * Set belowStandardEnglish
     *
     * @param string $belowStandardEnglish
     *
     * @return CourseContributesOutcome
     */
    public function setBelowStandardEnglish($belowStandardEnglish)
    {
        $this->belowStandardEnglish = $belowStandardEnglish;

        return $this;
    }

    /**
     * Get belowStandardEnglish
     *
     * @return string
     */
    public function getBelowStandardEnglish()
    {
        return $this->belowStandardEnglish;
    }

    /**
     * Set competentEnglish
     *
     * @param string $competentEnglish
     *
     * @return CourseContributesOutcome
     */
    public function setCompetentEnglish($competentEnglish)
    {
        $this->competentEnglish = $competentEnglish;

        return $this;
    }

    /**
     * Get competentEnglish
     *
     * @return string
     */
    public function getCompetentEnglish()
    {
        return $this->competentEnglish;
    }

    /**
     * Set exemplaryEnglish
     *
     * @param string $exemplaryEnglish
     *
     * @return CourseContributesOutcome
     */
    public function setExemplaryEnglish($exemplaryEnglish)
    {
        $this->exemplaryEnglish = $exemplaryEnglish;

        return $this;
    }

    /**
     * Get exemplaryEnglish
     *
     * @return string
     */
    public function getExemplaryEnglish()
    {
        return $this->exemplaryEnglish;
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
}

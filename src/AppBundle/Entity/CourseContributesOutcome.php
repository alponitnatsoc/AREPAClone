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
     * @ORM\Column(name="id_course_aports_outcome",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idCourseAportsOutcome;

    /**
     * @var integer
     * @ORM\Column(name="bloom_level",type="integer", length=1)
     */
    private $bloomLevel;

    /**
     * @var string
     * @ORM\Column(name="below_standard",type="text",nullable=true,length=20000)
     */
    private $belowStandard;

    /**
     * @var string
     * @ORM\Column(name="competent",type="text",nullable=true,length=20000)
     */
    private $competent;

    /**
     * @var string
     * @ORM\Column(name="exemplary",type="text",nullable=true,length=20000)
     */
    private $exemplary;

    /**
     * @var string
     * @ORM\Column(name="english_below_standard",type="text",nullable=true,length=20000)
     */
    private $englishBelowStandard;

    /**
     * @var string
     * @ORM\Column(name="english_competent",type="text",nullable=true,length=20000)
     */
    private $englishCompetent;

    /**
     * @var string
     * @ORM\Column(name="english_exemplary",type="text",nullable=true,length=20000)
     */
    private $englishExemplary;

    /**
     * @var Content
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Course", inversedBy="courseContributesOutcome")
     * @ORM\JoinColumn(name="course_id", referencedColumnName="id_course")
     */
    private $courseCourse;

    /**
     * @var Outcome
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Outcome", inversedBy="courseContributesOutcome")
     * @ORM\JoinColumn(name="outcome_id", referencedColumnName="id_outcome")
     */
    private $outcomeOutcome;


    /**
     * Get idCourseAportsOutcome
     *
     * @return integer
     */
    public function getIdCourseAportsOutcome()
    {
        return $this->idCourseAportsOutcome;
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
     * Set belowStandard
     *
     * @param string $belowStandard
     *
     * @return CourseContributesOutcome
     */
    public function setBelowStandard($belowStandard)
    {
        $this->belowStandard = $belowStandard;

        return $this;
    }

    /**
     * Get belowStandard
     *
     * @return string
     */
    public function getBelowStandard()
    {
        return $this->belowStandard;
    }

    /**
     * Set competent
     *
     * @param string $competent
     *
     * @return CourseContributesOutcome
     */
    public function setCompetent($competent)
    {
        $this->competent = $competent;

        return $this;
    }

    /**
     * Get competent
     *
     * @return string
     */
    public function getCompetent()
    {
        return $this->competent;
    }

    /**
     * Set exemplary
     *
     * @param string $exemplary
     *
     * @return CourseContributesOutcome
     */
    public function setExemplary($exemplary)
    {
        $this->exemplary = $exemplary;

        return $this;
    }

    /**
     * Get exemplary
     *
     * @return string
     */
    public function getExemplary()
    {
        return $this->exemplary;
    }

    /**
     * Set englishBelowStandard
     *
     * @param string $englishBelowStandard
     *
     * @return CourseContributesOutcome
     */
    public function setEnglishBelowStandard($englishBelowStandard)
    {
        $this->englishBelowStandard = $englishBelowStandard;

        return $this;
    }

    /**
     * Get englishBelowStandard
     *
     * @return string
     */
    public function getEnglishBelowStandard()
    {
        return $this->englishBelowStandard;
    }

    /**
     * Set englishCompetent
     *
     * @param string $englishCompetent
     *
     * @return CourseContributesOutcome
     */
    public function setEnglishCompetent($englishCompetent)
    {
        $this->englishCompetent = $englishCompetent;

        return $this;
    }

    /**
     * Get englishCompetent
     *
     * @return string
     */
    public function getEnglishCompetent()
    {
        return $this->englishCompetent;
    }

    /**
     * Set englishExemplary
     *
     * @param string $englishExemplary
     *
     * @return CourseContributesOutcome
     */
    public function setEnglishExemplary($englishExemplary)
    {
        $this->englishExemplary = $englishExemplary;

        return $this;
    }

    /**
     * Get englishExemplary
     *
     * @return string
     */
    public function getEnglishExemplary()
    {
        return $this->englishExemplary;
    }

    /**
     * Set courseCourse
     *
     * @param \AppBundle\Entity\Course $courseCourse
     *
     * @return CourseContributesOutcome
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

    /**
     * Set outcomeOutcome
     *
     * @param \AppBundle\Entity\Outcome $outcomeOutcome
     *
     * @return CourseContributesOutcome
     */
    public function setOutcomeOutcome(\AppBundle\Entity\Outcome $outcomeOutcome = null)
    {
        $this->outcomeOutcome = $outcomeOutcome;

        return $this;
    }

    /**
     * Get outcomeOutcome
     *
     * @return \AppBundle\Entity\Outcome
     */
    public function getOutcomeOutcome()
    {
        return $this->outcomeOutcome;
    }
}

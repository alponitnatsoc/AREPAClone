<?php
/**
 * Created by PhpStorm.
 * User: erikaxu
 * Date: 14/09/16
 * Time: 06:57 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class Outcome
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="outcome",
 *     uniqueConstraints={
 *          @UniqueConstraint(
 *              name="outcomeUnique", columns={"name_outcome"}
 *          )
 *     })
 * @ORM\Entity
 */
class Outcome
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id_outcome",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idOutcome;

    /**
     * @var string
     *
     * @ORM\Column(name="name_outcome",type="string")
     */
    private $nameOutcome;

    /**
     * @var string
     *
     * @ORM\Column(name="description_outcome",length=20000,type="text",nullable=true)
     */
    private $descriptionOutcome;

    /**
     * @var string
     *
     * @ORM\Column(name="english_description_outcome",length=20000,type="text",nullable=true)
     */
    private $englishDescriptionOutcome;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\OutcomeValue",mappedBy="outcomeOutcome")
     */
    private $outcomeValue;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\AssessmentToolContributeOutcomes", mappedBy="outcomeOutcome", cascade={"persist", "remove"})
     */
    private $assessmentToolContributeOutcomes;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ContentContributesOutcome", mappedBy="outcomeOutcome", cascade={"persist", "remove"})
     */
    private $contentContributesOutcome;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\CourseContributesOutcome", mappedBy="outcomeOutcome", cascade={"persist", "remove"})
     */
    private $courseContributesOutcome;

    /**
     * ToString
     *
     * @return string
     */
    public function __toString()
    {
        return $this->nameOutcome;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->outcomeValue = new \Doctrine\Common\Collections\ArrayCollection();
        $this->assessmentToolContributeOutcomes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->contentContributesOutcome = new \Doctrine\Common\Collections\ArrayCollection();
        $this->courseContributesOutcome = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get idOutcome
     *
     * @return integer
     */
    public function getIdOutcome()
    {
        return $this->idOutcome;
    }

    /**
     * Set nameOutcome
     *
     * @param string $nameOutcome
     *
     * @return Outcome
     */
    public function setNameOutcome($nameOutcome)
    {
        $this->nameOutcome = $nameOutcome;

        return $this;
    }

    /**
     * Get nameOutcome
     *
     * @return string
     */
    public function getNameOutcome()
    {
        return $this->nameOutcome;
    }

    /**
     * Set descriptionOutcome
     *
     * @param string $descriptionOutcome
     *
     * @return Outcome
     */
    public function setDescriptionOutcome($descriptionOutcome)
    {
        $this->descriptionOutcome = $descriptionOutcome;

        return $this;
    }

    /**
     * Get descriptionOutcome
     *
     * @return string
     */
    public function getDescriptionOutcome()
    {
        return $this->descriptionOutcome;
    }

    /**
     * Set englishDescriptionOutcome
     *
     * @param string $englishDescriptionOutcome
     *
     * @return Outcome
     */
    public function setEnglishDescriptionOutcome($englishDescriptionOutcome)
    {
        $this->englishDescriptionOutcome = $englishDescriptionOutcome;

        return $this;
    }

    /**
     * Get englishDescriptionOutcome
     *
     * @return string
     */
    public function getEnglishDescriptionOutcome()
    {
        return $this->englishDescriptionOutcome;
    }

    /**
     * Add outcomeValue
     *
     * @param \AppBundle\Entity\OutcomeValue $outcomeValue
     *
     * @return Outcome
     */
    public function addOutcomeValue(\AppBundle\Entity\OutcomeValue $outcomeValue)
    {
        $this->outcomeValue[] = $outcomeValue;

        return $this;
    }

    /**
     * Remove outcomeValue
     *
     * @param \AppBundle\Entity\OutcomeValue $outcomeValue
     */
    public function removeOutcomeValue(\AppBundle\Entity\OutcomeValue $outcomeValue)
    {
        $this->outcomeValue->removeElement($outcomeValue);
    }

    /**
     * Get outcomeValue
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOutcomeValue()
    {
        return $this->outcomeValue;
    }

    /**
     * Add assessmentToolContributeOutcome
     *
     * @param \AppBundle\Entity\AssessmentToolContributeOutcomes $assessmentToolContributeOutcome
     *
     * @return Outcome
     */
    public function addAssessmentToolContributeOutcome(\AppBundle\Entity\AssessmentToolContributeOutcomes $assessmentToolContributeOutcome)
    {
        $this->assessmentToolContributeOutcomes[] = $assessmentToolContributeOutcome;

        return $this;
    }

    /**
     * Remove assessmentToolContributeOutcome
     *
     * @param \AppBundle\Entity\AssessmentToolContributeOutcomes $assessmentToolContributeOutcome
     */
    public function removeAssessmentToolContributeOutcome(\AppBundle\Entity\AssessmentToolContributeOutcomes $assessmentToolContributeOutcome)
    {
        $this->assessmentToolContributeOutcomes->removeElement($assessmentToolContributeOutcome);
    }

    /**
     * Get assessmentToolContributeOutcomes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAssessmentToolContributeOutcomes()
    {
        return $this->assessmentToolContributeOutcomes;
    }

    /**
     * Add contentContributesOutcome
     *
     * @param \AppBundle\Entity\ContentContributesOutcome $contentContributesOutcome
     *
     * @return Outcome
     */
    public function addContentContributesOutcome(\AppBundle\Entity\ContentContributesOutcome $contentContributesOutcome)
    {
        $this->contentContributesOutcome[] = $contentContributesOutcome;

        return $this;
    }

    /**
     * Remove contentContributesOutcome
     *
     * @param \AppBundle\Entity\ContentContributesOutcome $contentContributesOutcome
     */
    public function removeContentContributesOutcome(\AppBundle\Entity\ContentContributesOutcome $contentContributesOutcome)
    {
        $this->contentContributesOutcome->removeElement($contentContributesOutcome);
    }

    /**
     * Get contentContributesOutcome
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContentContributesOutcome()
    {
        return $this->contentContributesOutcome;
    }

    /**
     * Add courseContributesOutcome
     *
     * @param \AppBundle\Entity\CourseContributesOutcome $courseContributesOutcome
     *
     * @return Outcome
     */
    public function addCourseContributesOutcome(\AppBundle\Entity\CourseContributesOutcome $courseContributesOutcome)
    {
        $this->courseContributesOutcome[] = $courseContributesOutcome;

        return $this;
    }

    /**
     * Remove courseContributesOutcome
     *
     * @param \AppBundle\Entity\CourseContributesOutcome $courseContributesOutcome
     */
    public function removeCourseContributesOutcome(\AppBundle\Entity\CourseContributesOutcome $courseContributesOutcome)
    {
        $this->courseContributesOutcome->removeElement($courseContributesOutcome);
    }

    /**
     * Get courseContributesOutcome
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCourseContributesOutcome()
    {
        return $this->courseContributesOutcome;
    }
}

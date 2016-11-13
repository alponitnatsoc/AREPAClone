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
 * Class ContentContributesOutcome
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="content_contributes_outcome")
 * @ORM\Entity
 */
class ContentContributesOutcome
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_content_contributes_outcome",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idContentContributesOutcome;

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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Content", inversedBy="contentContributesOutcomes")
     * @ORM\JoinColumn(name="content_id", referencedColumnName="id_content")
     */
    private $contentContent;

    /**
     * @var Outcome
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Outcome", inversedBy="contentContributesOutcome")
     * @ORM\JoinColumn(name="outcome_id", referencedColumnName="id_outcome")
     */
    private $outcomeOutcome;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Period")
     * @ORM\JoinColumn(name="period_id",referencedColumnName="id_period",nullable=true)
     */
    private $period;

    /**
     * Get idContentContributesOutcome
     *
     * @return integer
     */
    public function getIdContentContributesOutcome()
    {
        return $this->idContentContributesOutcome;
    }

    /**
     * Set belowStandard
     *
     * @param string $belowStandard
     *
     * @return ContentContributesOutcome
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
     * @return ContentContributesOutcome
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
     * @return ContentContributesOutcome
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
     * @return ContentContributesOutcome
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
     * @return ContentContributesOutcome
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
     * @return ContentContributesOutcome
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
     * Set contentContent
     *
     * @param \AppBundle\Entity\Content $contentContent
     *
     * @return ContentContributesOutcome
     */
    public function setContentContent(\AppBundle\Entity\Content $contentContent = null)
    {
        $this->contentContent = $contentContent;

        return $this;
    }

    /**
     * Get contentContent
     *
     * @return \AppBundle\Entity\Content
     */
    public function getContentContent()
    {
        return $this->contentContent;
    }

    /**
     * Set outcomeOutcome
     *
     * @param \AppBundle\Entity\Outcome $outcomeOutcome
     *
     * @return ContentContributesOutcome
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

    /**
     * Set period
     *
     * @param \AppBundle\Entity\Period $period
     *
     * @return ContentContributesOutcome
     */
    public function setPeriod(\AppBundle\Entity\Period $period = null)
    {
        $this->period = $period;

        return $this;
    }

    /**
     * Get period
     *
     * @return \AppBundle\Entity\Period
     */
    public function getPeriod()
    {
        return $this->period;
    }
}

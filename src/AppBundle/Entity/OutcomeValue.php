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
 * Class OutcomeValue
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="outcome_value",
 *     uniqueConstraints={
 *          @UniqueConstraint(
 *              name="periodOutcomeUnique", columns={"outcome_id","period_id"}
 *          )
 *     })
 * @ORM\Entity
 */
class OutcomeValue
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id_outcome_value",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idOutcomeValue;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Outcome",inversedBy="outcomeValue",cascade={"persist","remove"})
     * @ORM\JoinColumn(name="outcome_id",referencedColumnName="id_outcome",nullable=true)
     */
    private $outcomeOutcome;

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
     * @var float
     *
     * @ORM\Column(name="exalumns_outcome_value",type="float",nullable=true)
     */
    private $exalumnsOutcomeValue;

    /**
     * @var float
     *
     * @ORM\Column(name="internal_outcome_value",type="float",nullable=true)
     */
    private $internalOutcomeValue;

    /**
     * @var float
     *
     * @ORM\Column(name="exalumns_porcentage_value",type="float",nullable=true)
     */
    private $exalumnsPorcentageValue;

    /**
     * @var float
     *
     * @ORM\Column(name="total_value",type="float",nullable=true)
     */
    private $totalValue;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Period")
     * @ORM\JoinColumn(name="period_id",referencedColumnName="id_period",nullable=true)
     */
    private $period;


    /**
     * Get idOutcomeValue
     *
     * @return integer
     */
    public function getIdOutcomeValue()
    {
        return $this->idOutcomeValue;
    }

    /**
     * Set belowStandard
     *
     * @param string $belowStandard
     *
     * @return OutcomeValue
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
     * @return OutcomeValue
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
     * @return OutcomeValue
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
     * @return OutcomeValue
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
     * @return OutcomeValue
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
     * @return OutcomeValue
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
     * Set exalumnsOutcomeValue
     *
     * @param float $exalumnsOutcomeValue
     *
     * @return OutcomeValue
     */
    public function setExalumnsOutcomeValue($exalumnsOutcomeValue)
    {
        $this->exalumnsOutcomeValue = $exalumnsOutcomeValue;

        return $this;
    }

    /**
     * Get exalumnsOutcomeValue
     *
     * @return float
     */
    public function getExalumnsOutcomeValue()
    {
        return $this->exalumnsOutcomeValue;
    }

    /**
     * Set internalOutcomeValue
     *
     * @param float $internalOutcomeValue
     *
     * @return OutcomeValue
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
     * Set exalumnsPorcentageValue
     *
     * @param float $exalumnsPorcentageValue
     *
     * @return OutcomeValue
     */
    public function setExalumnsPorcentageValue($exalumnsPorcentageValue)
    {
        $this->exalumnsPorcentageValue = $exalumnsPorcentageValue;

        return $this;
    }

    /**
     * Get exalumnsPorcentageValue
     *
     * @return float
     */
    public function getExalumnsPorcentageValue()
    {
        return $this->exalumnsPorcentageValue;
    }

    /**
     * Set totalValue
     *
     * @param float $totalValue
     *
     * @return OutcomeValue
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
     * Set outcomeOutcome
     *
     * @param \AppBundle\Entity\Outcome $outcomeOutcome
     *
     * @return OutcomeValue
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
     * @return OutcomeValue
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

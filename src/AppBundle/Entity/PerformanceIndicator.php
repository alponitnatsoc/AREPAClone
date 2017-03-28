<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 14/09/16
 * Time: 06:57 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class PerformanceIndicator
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="performance_indicator")
 * @ORM\Entity
 */
class PerformanceIndicator
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id_performance_indicator",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idPerformanceIndicator;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\BloomLevel")
     * @ORM\JoinColumn(name="bloom_level", referencedColumnName="level")
     */
    private $bloomLevel;

    /**
     * @ORM\Column(name="description_en", type="text", nullable=TRUE)
     */
    private $descriptionEN;

    /**
     * @ORM\Column(name="description_es", type="text", nullable=TRUE)
     */
    private $descriptionES;

    /**
     * @ORM\Column(name="exemplary_en", type="text", nullable=TRUE)
     */
    private $exemplaryEN;

    /**
     * @ORM\Column(name="exemplary_es", type="text", nullable=TRUE)
     */
    private $exemplaryES;

    /**
     * @ORM\Column(name="competent_en", type="text", nullable=TRUE)
     */
    private $competentEN;

    /**
     * @ORM\Column(name="competent_es", type="text", nullable=TRUE)
     */
    private $competentES;

    /**
     * @ORM\Column(name="below_standard_en", type="text", nullable=TRUE)
     */
    private $belowStandardEN;

    /**
     * @ORM\Column(name="below_standard_es", type="text", nullable=TRUE)
     */
    private $belowStandardES;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Outcome",inversedBy="performanceIndicators", cascade={"persist"})
     * @ORM\JoinColumn(name="outcome_id", referencedColumnName="id_outcome")
     */
    private $outcome;

    /**
     * Get idPerformanceIndicator
     *
     * @return integer
     */
    public function getIdPerformanceIndicator()
    {
        return $this->idPerformanceIndicator;
    }

    /**
     * Set descriptionEN
     *
     * @param string $descriptionEN
     *
     * @return PerformanceIndicator
     */
    public function setDescriptionEN($descriptionEN)
    {
        $this->descriptionEN = $descriptionEN;

        return $this;
    }

    /**
     * Get descriptionEN
     *
     * @return string
     */
    public function getDescriptionEN()
    {
        return $this->descriptionEN;
    }

    /**
     * Set descriptionES
     *
     * @param string $descriptionES
     *
     * @return PerformanceIndicator
     */
    public function setDescriptionES($descriptionES)
    {
        $this->descriptionES = $descriptionES;

        return $this;
    }

    /**
     * Get descriptionES
     *
     * @return string
     */
    public function getDescriptionES()
    {
        return $this->descriptionES;
    }

    /**
     * Set exemplaryEN
     *
     * @param string $exemplaryEN
     *
     * @return PerformanceIndicator
     */
    public function setExemplaryEN($exemplaryEN)
    {
        $this->exemplaryEN = $exemplaryEN;

        return $this;
    }

    /**
     * Get exemplaryEN
     *
     * @return string
     */
    public function getExemplaryEN()
    {
        return $this->exemplaryEN;
    }

    /**
     * Set exemplaryES
     *
     * @param string $exemplaryES
     *
     * @return PerformanceIndicator
     */
    public function setExemplaryES($exemplaryES)
    {
        $this->exemplaryES = $exemplaryES;

        return $this;
    }

    /**
     * Get exemplaryES
     *
     * @return string
     */
    public function getExemplaryES()
    {
        return $this->exemplaryES;
    }

    /**
     * Set competentEN
     *
     * @param string $competentEN
     *
     * @return PerformanceIndicator
     */
    public function setCompetentEN($competentEN)
    {
        $this->competentEN = $competentEN;

        return $this;
    }

    /**
     * Get competentEN
     *
     * @return string
     */
    public function getCompetentEN()
    {
        return $this->competentEN;
    }

    /**
     * Set competentES
     *
     * @param string $competentES
     *
     * @return PerformanceIndicator
     */
    public function setCompetentES($competentES)
    {
        $this->competentES = $competentES;

        return $this;
    }

    /**
     * Get competentES
     *
     * @return string
     */
    public function getCompetentES()
    {
        return $this->competentES;
    }

    /**
     * Set belowStandardEN
     *
     * @param string $belowStandardEN
     *
     * @return PerformanceIndicator
     */
    public function setBelowStandardEN($belowStandardEN)
    {
        $this->belowStandardEN = $belowStandardEN;

        return $this;
    }

    /**
     * Get belowStandardEN
     *
     * @return string
     */
    public function getBelowStandardEN()
    {
        return $this->belowStandardEN;
    }

    /**
     * Set belowStandardES
     *
     * @param string $belowStandardES
     *
     * @return PerformanceIndicator
     */
    public function setBelowStandardES($belowStandardES)
    {
        $this->belowStandardES = $belowStandardES;

        return $this;
    }

    /**
     * Get belowStandardES
     *
     * @return string
     */
    public function getBelowStandardES()
    {
        return $this->belowStandardES;
    }

    /**
     * Set bloomLevel
     *
     * @param \AppBundle\Entity\BloomLevel $bloomLevel
     *
     * @return PerformanceIndicator
     */
    public function setBloomLevel(\AppBundle\Entity\BloomLevel $bloomLevel = null)
    {
        $this->bloomLevel = $bloomLevel;

        return $this;
    }

    /**
     * Get bloomLevel
     *
     * @return \AppBundle\Entity\BloomLevel
     */
    public function getBloomLevel()
    {
        return $this->bloomLevel;
    }

    /**
     * Set outcome
     *
     * @param \AppBundle\Entity\Outcome $outcome
     *
     * @return PerformanceIndicator
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

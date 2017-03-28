<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 14/09/16
 * Time: 06:57 PM
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class Outcome
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="outcome")
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
     * @ORM\Column(name="name",type="string",unique=TRUE)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description_spanish",length=20000,type="text",nullable=true)
     */
    private $descriptionSpanish;

    /**
     * @var string
     *
     * @ORM\Column(name="description_english",length=20000,type="text",nullable=true)
     */
    private $descriptionEnglish;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\CourseContributesOutcome", mappedBy="outcome", cascade={"persist", "remove"})
     */
    private $courseContributesOutcome;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PerformanceIndicator", mappedBy="outcome", cascade={"persist", "remove"})
     */
    private $performanceIndicators;

    /**
     * ToString
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->courseContributesOutcome = new \Doctrine\Common\Collections\ArrayCollection();
        $this->performanceIndicators = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Outcome
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set descriptionSpanish
     *
     * @param string $descriptionSpanish
     *
     * @return Outcome
     */
    public function setDescriptionSpanish($descriptionSpanish)
    {
        $this->descriptionSpanish = $descriptionSpanish;

        return $this;
    }

    /**
     * Get descriptionSpanish
     *
     * @return string
     */
    public function getDescriptionSpanish()
    {
        return $this->descriptionSpanish;
    }

    /**
     * Set descriptionEnglish
     *
     * @param string $descriptionEnglish
     *
     * @return Outcome
     */
    public function setDescriptionEnglish($descriptionEnglish)
    {
        $this->descriptionEnglish = $descriptionEnglish;

        return $this;
    }

    /**
     * Get descriptionEnglish
     *
     * @return string
     */
    public function getDescriptionEnglish()
    {
        return $this->descriptionEnglish;
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
        $courseContributesOutcome->setOutcome($this);
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

    /**
     * Add performanceIndicator
     *
     * @param \AppBundle\Entity\PerformanceIndicator $performanceIndicator
     *
     * @return Outcome
     */
    public function addPerformanceIndicator(\AppBundle\Entity\PerformanceIndicator $performanceIndicator)
    {
        $this->performanceIndicators[] = $performanceIndicator;

        return $this;
    }

    /**
     * Remove performanceIndicator
     *
     * @param \AppBundle\Entity\PerformanceIndicator $performanceIndicator
     */
    public function removePerformanceIndicator(\AppBundle\Entity\PerformanceIndicator $performanceIndicator)
    {
        $performanceIndicator->setOutcome($this);
        $this->performanceIndicators->removeElement($performanceIndicator);
    }

    /**
     * Get performanceIndicators
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPerformanceIndicators()
    {
        return $this->performanceIndicators;
    }

    /**
     * returns the performance indicators for the bloomLevel passed by parameter
     * @param $bloomLevel
     * @return \Doctrine\Common\Collections\ArrayCollection|\Doctrine\Common\Collections\Collection|null
     */
    public function getPerformanceIndicatorsByBloomLevel($bloomLevel)
    {
        $criteria = Criteria::create()->where(Criteria::expr()->eq('bloomLevel',$bloomLevel));
        return ($this->performanceIndicators->matching($criteria)->count()>0)?$this->performanceIndicators->matching($criteria):null;
    }
}

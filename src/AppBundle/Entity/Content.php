<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 24/09/16
 * Time: 03:11 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class Content
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="content")
 * @ORM\Entity
 */
class Content
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_content",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idContent;

    /**
     * @ORM\Column(name="percentage_grade", type="float")
     */
    private $percentageGrade=0.0;

    /**
     * @ORM\Column(name="percentage_assessment_tool", type="float")
     */
    private $percentageAssessmentTool=0.0;

    /**
     * @ORM\Column(name="name",type="string",nullable=true);
     */
    private $name;

    /**
     * @ORM\Column(name="info",type="text",nullable=true);
     */
    private $info;

    /**
     * @var boolean
     * @ORM\Column(name="contribute_outcome",type="boolean",nullable=true)
     */
    private $contributeOutcome;

    /**
     * @var RubricHasAssessmentTool
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\RubricHasAssessmentTool", inversedBy="contents", cascade={"persist"})
     * @ORM\JoinColumn(name="rubric_has_assessment_tool_id", referencedColumnName="id_rubric_has_assessment_tool")
     */
    private $rubricHasAssessmentTool;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ContentContributesOutcome", mappedBy="contentContent", cascade={"persist", "remove"})
     */
    private $contentContributesOutcomes;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ContentGrade", mappedBy="contentContent", cascade={"persist", "remove"})
     */
    private $contentGrade;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contentContributesOutcomes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->contentGrade = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get idContent
     *
     * @return integer
     */
    public function getIdContent()
    {
        return $this->idContent;
    }

    /**
     * Set percentageGrade
     *
     * @param float $percentageGrade
     *
     * @return Content
     */
    public function setPercentageGrade($percentageGrade)
    {
        $this->percentageGrade = $percentageGrade;

        return $this;
    }

    /**
     * Get percentageGrade
     *
     * @return float
     */
    public function getPercentageGrade()
    {
        return $this->percentageGrade;
    }

    /**
     * Set percentageAssessmentTool
     *
     * @param float $percentageAssessmentTool
     *
     * @return Content
     */
    public function setPercentageAssessmentTool($percentageAssessmentTool)
    {
        $this->percentageAssessmentTool = $percentageAssessmentTool;

        return $this;
    }

    /**
     * Get percentageAssessmentTool
     *
     * @return float
     */
    public function getPercentageAssessmentTool()
    {
        return $this->percentageAssessmentTool;
    }

    /**
     * Set rubricHasAssessmentTool
     *
     * @param \AppBundle\Entity\RubricHasAssessmentTool $rubricHasAssessmentTool
     *
     * @return Content
     */
    public function setRubricHasAssessmentTool(\AppBundle\Entity\RubricHasAssessmentTool $rubricHasAssessmentTool = null)
    {
        $this->rubricHasAssessmentTool = $rubricHasAssessmentTool;

        return $this;
    }

    /**
     * Get rubricHasAssessmentTool
     *
     * @return \AppBundle\Entity\RubricHasAssessmentTool
     */
    public function getRubricHasAssessmentTool()
    {
        return $this->rubricHasAssessmentTool;
    }

    /**
     * Add contentContributesOutcome
     *
     * @param \AppBundle\Entity\ContentContributesOutcome $contentContributesOutcome
     *
     * @return Content
     */
    public function addContentContributesOutcome(\AppBundle\Entity\ContentContributesOutcome $contentContributesOutcome)
    {
        $this->contentContributesOutcomes[] = $contentContributesOutcome;
        $contentContributesOutcome->setContentContent($this);
        return $this;
    }

    /**
     * Remove contentContributesOutcome
     *
     * @param \AppBundle\Entity\ContentContributesOutcome $contentContributesOutcome
     */
    public function removeContentContributesOutcome(\AppBundle\Entity\ContentContributesOutcome $contentContributesOutcome)
    {
        $this->contentContributesOutcomes->removeElement($contentContributesOutcome);
    }

    /**
     * Get contentContributesOutcomes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContentContributesOutcomes()
    {
        return $this->contentContributesOutcomes;
    }

    /**
     * Add contentGrade
     *
     * @param \AppBundle\Entity\ContentGrade $contentGrade
     *
     * @return Content
     */
    public function addContentGrade(\AppBundle\Entity\ContentGrade $contentGrade)
    {
        $this->contentGrade[] = $contentGrade;
        return $this;
    }

    /**
     * Remove contentGrade
     *
     * @param \AppBundle\Entity\ContentGrade $contentGrade
     */
    public function removeContentGrade(\AppBundle\Entity\ContentGrade $contentGrade)
    {
        $this->contentGrade->removeElement($contentGrade);
    }

    /**
     * Get contentGrade
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContentGrade()
    {
        return $this->contentGrade;
    }

    /**
     * Set contributeOutcome
     *
     * @param boolean $contributeOutcome
     *
     * @return Content
     */
    public function setContributeOutcome($contributeOutcome)
    {
        $this->contributeOutcome = $contributeOutcome;

        return $this;
    }

    /**
     * Get contributeOutcome
     *
     * @return boolean
     */
    public function getContributeOutcome()
    {
        return $this->contributeOutcome;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Content
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
     * Set info
     *
     * @param string $info
     *
     * @return Content
     */
    public function setInfo($info)
    {
        $this->info = $info;

        return $this;
    }

    /**
     * Get info
     *
     * @return string
     */
    public function getInfo()
    {
        return $this->info;
    }
}

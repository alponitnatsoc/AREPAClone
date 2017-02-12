<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 17/09/16
 * Time: 03:43 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class AssessmentTool
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="assessment_tool")
 * @ORM\Entity
 */
class AssessmentTool
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_assessment_tool",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idAssessmentTool;

    /**
     * @var AssessmentToolType
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AssessmentToolType",inversedBy="assessmentTools",cascade={"persist","remove"})
     * @ORM\JoinColumn(name="assessment_tool_type_id",referencedColumnName="id_assessment_tool_type",nullable=true)
     */
    private $type;

    /**
     * @var boolean
     * @ORM\Column(name="contribute_outcome",type="boolean",nullable=true)
     */
    private $contributeOutcome;

    /**
     * @ORM\Column(name="percentage_grade", type="float")
     */
    private $percentageGrade = 0.0;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\AssessmentToolContributeOutcomes", mappedBy="assessmentTool", cascade={"persist", "remove"})
     */
    private $assessmentToolContributeOutcomes;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\RubricHasAssessmentTool", mappedBy="assessmentTool", cascade={"persist", "remove"})
     */
    private $rubricHasAssessmentTools;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\AssessmentToolGrade", mappedBy="assessmentTool", cascade={"persist", "remove"})
     */
    private $assessmentToolGrade;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->assessmentToolContributeOutcomes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->rubricHasAssessmentTools = new \Doctrine\Common\Collections\ArrayCollection();
        $this->assessmentToolGrade = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        if($this->getType())
            return $this->getType()->getName();
        return 'AssessmentTool';
    }

    /**
     * Get idAssessmentTool
     *
     * @return integer
     */
    public function getIdAssessmentTool()
    {
        return $this->idAssessmentTool;
    }

    /**
     * Set percentageGrade
     *
     * @param float $percentageGrade
     *
     * @return AssessmentTool
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
     * Set type
     *
     * @param \AppBundle\Entity\AssessmentToolType $type
     *
     * @return AssessmentTool
     */
    public function setType(\AppBundle\Entity\AssessmentToolType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \AppBundle\Entity\AssessmentToolType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Add assessmentToolContributeOutcome
     *
     * @param \AppBundle\Entity\AssessmentToolContributeOutcomes $assessmentToolContributeOutcome
     *
     * @return AssessmentTool
     */
    public function addAssessmentToolContributeOutcome(\AppBundle\Entity\AssessmentToolContributeOutcomes $assessmentToolContributeOutcome)
    {
        $this->assessmentToolContributeOutcomes[] = $assessmentToolContributeOutcome;
        $assessmentToolContributeOutcome->setAssessmentTool($this);
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
     * Add rubricHasAssessmentTool
     *
     * @param \AppBundle\Entity\RubricHasAssessmentTool $rubricHasAssessmentTool
     *
     * @return AssessmentTool
     */
    public function addRubricHasAssessmentTool(\AppBundle\Entity\RubricHasAssessmentTool $rubricHasAssessmentTool)
    {
        $this->rubricHasAssessmentTools[] = $rubricHasAssessmentTool;
        $rubricHasAssessmentTool->setAssessmentTool($this);
        return $this;
    }

    /**
     * Remove rubricHasAssessmentTool
     *
     * @param \AppBundle\Entity\RubricHasAssessmentTool $rubricHasAssessmentTool
     */
    public function removeRubricHasAssessmentTool(\AppBundle\Entity\RubricHasAssessmentTool $rubricHasAssessmentTool)
    {
        $this->rubricHasAssessmentTools->removeElement($rubricHasAssessmentTool);
    }

    /**
     * Get rubricHasAssessmentTools
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRubricHasAssessmentTools()
    {
        return $this->rubricHasAssessmentTools;
    }

    /**
     * Add assessmentToolGrade
     *
     * @param \AppBundle\Entity\AssessmentToolGrade $assessmentToolGrade
     *
     * @return AssessmentTool
     */
    public function addAssessmentToolGrade(\AppBundle\Entity\AssessmentToolGrade $assessmentToolGrade)
    {
        $this->assessmentToolGrade[] = $assessmentToolGrade;
        $assessmentToolGrade->setAssessmentTool($this);
        return $this;
    }

    /**
     * Remove assessmentToolGrade
     *
     * @param \AppBundle\Entity\AssessmentToolGrade $assessmentToolGrade
     */
    public function removeAssessmentToolGrade(\AppBundle\Entity\AssessmentToolGrade $assessmentToolGrade)
    {
        $this->assessmentToolGrade->removeElement($assessmentToolGrade);
    }

    /**
     * Get assessmentToolGrade
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAssessmentToolGrade()
    {
        return $this->assessmentToolGrade;
    }

    /**
     * Set contributeOutcome
     *
     * @param boolean $contributeOutcome
     *
     * @return AssessmentTool
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
}

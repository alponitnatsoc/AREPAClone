<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 24/09/16
 * Time: 03:14 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class RubricHasAssessmentTool
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="rubrick_has_assessment_tool")
 * @ORM\Entity
 */
class RubricHasAssessmentTool
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_rubric_has_assessment_tool",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idRubricHasAssessmentTool;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Content",mappedBy="rubricHasAssessmentTool")
     */
    private $contents;

    /**
     * @var Rubric
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Rubric",inversedBy="rubricHasAssessmentTools",cascade={"persist","remove"})
     * @ORM\JoinColumn(name="rubric_id", referencedColumnName="id_rubric")
     */
    private $rubricRubric;

    /**
     * @var AssessmentTool
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AssessmentTool", inversedBy="rubricHasAssessmentTools",cascade={"persist","remove"})
     * @ORM\JoinColumn(name="assessment_tool_id",referencedColumnName="id_assessment_tool")
     */
    private $assessmentTool;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contents = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get idRubricHasAssessmentTool
     *
     * @return integer
     */
    public function getIdRubricHasAssessmentTool()
    {
        return $this->idRubricHasAssessmentTool;
    }

    /**
     * Add content
     *
     * @param \AppBundle\Entity\Content $content
     *
     * @return RubricHasAssessmentTool
     */
    public function addContent(\AppBundle\Entity\Content $content)
    {
        $this->contents[] = $content;
        return $this;
    }

    /**
     * Remove content
     *
     * @param \AppBundle\Entity\Content $content
     */
    public function removeContent(\AppBundle\Entity\Content $content)
    {
        $this->contents->removeElement($content);
    }

    /**
     * Get contents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContents()
    {
        return $this->contents;
    }

    /**
     * Set rubricRubric
     *
     * @param \AppBundle\Entity\Rubric $rubricRubric
     *
     * @return RubricHasAssessmentTool
     */
    public function setRubricRubric(\AppBundle\Entity\Rubric $rubricRubric = null)
    {
        $this->rubricRubric = $rubricRubric;

        return $this;
    }

    /**
     * Get rubricRubric
     *
     * @return \AppBundle\Entity\Rubric
     */
    public function getRubricRubric()
    {
        return $this->rubricRubric;
    }

    /**
     * Set assessmentTool
     *
     * @param \AppBundle\Entity\AssessmentTool $assessmentTool
     *
     * @return RubricHasAssessmentTool
     */
    public function setAssessmentTool(\AppBundle\Entity\AssessmentTool $assessmentTool = null)
    {
        $this->assessmentTool = $assessmentTool;

        return $this;
    }

    /**
     * Get assessmentTool
     *
     * @return \AppBundle\Entity\AssessmentTool
     */
    public function getAssessmentTool()
    {
        return $this->assessmentTool;
    }
}

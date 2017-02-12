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
 * Class AssessmentToolType
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="assessment_tool_type")
 * @ORM\Entity
 */
class AssessmentToolType
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_assessment_tool_type",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idAssessmentToolType;

    /**
     * @var string
     * @ORM\Column(name="name",type="string",nullable=true)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\AssessmentTool",mappedBy="type",cascade={"persist","remove"})
     */
    private $assessmentTools;

    public function __toString()
    {
        return $this->name;
    }

    /**
     * Get idAssessmentToolType
     *
     * @return integer
     */
    public function getIdAssessmentToolType()
    {
        return $this->idAssessmentToolType;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return AssessmentToolType
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
     * Add assessmentTool
     *
     * @param \AppBundle\Entity\AssessmentTool $assessmentTool
     *
     * @return AssessmentToolType
     */
    public function addAssessmentTool(\AppBundle\Entity\AssessmentTool $assessmentTool)
    {
        $this->assessmentTools[] = $assessmentTool;
        $assessmentTool->setType($this);
        return $this;
    }

    /**
     * Remove assessmentTool
     *
     * @param \AppBundle\Entity\AssessmentTool $assessmentTool
     */
    public function removeAssessmentTool(\AppBundle\Entity\AssessmentTool $assessmentTool)
    {
        $this->assessmentTools->removeElement($assessmentTool);
    }

    /**
     * Get assessmentTools
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAssessmentTools()
    {
        return $this->assessmentTools;
    }


}

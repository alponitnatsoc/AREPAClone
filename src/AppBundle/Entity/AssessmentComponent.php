<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 1/03/17
 * Time: 01:44 AM
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Role
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="assessment_component")
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"assessmentTool" = "AssessmentTool","assessmentContent"="AssessmentContent"})
 */
abstract class AssessmentComponent
{
    /**
     * @var integer
     * @ORM\Column(name="id_assessment_component",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $idAssessmentComponent;

    /**
     * @var string
     *
     * @ORM\Column(name="name",type="string", nullable=true)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description",type="string", nullable=true)
     */
    protected $description;

    /**
     * @var float
     *
     * @ORM\Column(name="percentage",type="float")
     */
    protected $percentage;

    /**
     * @var AssessmentTool
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AssessmentTool", inversedBy="assessmentComponents", cascade={"persist"})
     * @ORM\JoinColumn(name="assessment_tool", referencedColumnName="id_assessment_component", nullable=TRUE)
     */
    protected $assessmentTool;

    /**
     * get class
     * returns the name of the class for the child entities
     * @return string
     */
    public function getClass(){
        $path = explode('\\', __CLASS__);
        return array_pop($path);
    }

    /**
     * Get idAssessmentComponent
     *
     * @return integer
     */
    public function getIdAssessmentComponent()
    {
        return $this->idAssessmentComponent;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return AssessmentComponent
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
     * Set description
     *
     * @param string $description
     *
     * @return AssessmentComponent
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set percentage
     *
     * @param float $percentage
     *
     * @return AssessmentComponent
     */
    public function setPercentage($percentage)
    {
        $this->percentage = $percentage;

        return $this;
    }

    /**
     * Get percentage
     *
     * @return float
     */
    public function getPercentage()
    {
        return $this->percentage;
    }

    /**
     * Set assessmentTool
     *
     * @param \AppBundle\Entity\AssessmentTool $assessmentTool
     *
     * @return AssessmentComponent
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

<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 1/03/17
 * Time: 01:52 AM
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class AssessmentTool
 * @package AppBundle\Entity
 *
 * @ORM\Entity()
 */
class AssessmentTool extends AssessmentComponent
{

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\AssessmentComponent", mappedBy="assessmentTool", cascade={"persist"})
     */
    private $assessmentComponents;

    /**
     * get class
     * returns the name of the class
     * @return string
     */
    public function getClass(){
        $path = explode('\\', __CLASS__);
        return array_pop($path);
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->assessmentComponents = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add assessmentComponent
     *
     * @param \AppBundle\Entity\AssessmentComponent $assessmentComponent
     *
     * @return AssessmentTool
     */
    public function addAssessmentComponent(\AppBundle\Entity\AssessmentComponent $assessmentComponent)
    {
        $this->assessmentComponents[] = $assessmentComponent;

        return $this;
    }

    /**
     * Remove assessmentComponent
     *
     * @param \AppBundle\Entity\AssessmentComponent $assessmentComponent
     */
    public function removeAssessmentComponent(\AppBundle\Entity\AssessmentComponent $assessmentComponent)
    {
        $this->assessmentComponents->removeElement($assessmentComponent);
    }

    /**
     * Get assessmentComponents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAssessmentComponents()
    {
        return $this->assessmentComponents;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 1/03/17
 * Time: 01:52 AM
 */

namespace AppBundle\Entity;
use Assetic\Exception\Exception;
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
     * @return AssessmentTool
     * @throws \Exception
     */
    public function addAssessmentComponent(\AppBundle\Entity\AssessmentComponent $assessmentComponent)
    {
        if($this->percentage += $assessmentComponent->getPercentage()<=1){
            $assessmentComponent->setAssessmentTool($this);
            $this->percentage += $assessmentComponent->getPercentage();
            $this->assessmentComponents[] = $assessmentComponent;
        }else{
            throw new \Exception('The assessment component exceeds the allowed percentage for this assessment tool');
        }
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

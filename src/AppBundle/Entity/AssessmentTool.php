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
     * @var boolean
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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\RubricHasAssessmentTool", mappedBy="assessmentToolassessmentTools", cascade={"persist", "remove"})
     */
    private $rubricHasAssessmentTools;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\AssessmentToolGrade", mappedBy="assessmentTool", cascade={"persist", "remove"})
     */
    private $assessmentToolGrade;

}
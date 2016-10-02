<?php
/**
 * Created by PhpStorm.
 * User: erikaxu
 * Date: 24/09/16
 * Time: 08:02 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class AssessmentToolContributeOutcomes
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="assessment_tool_contribute_outcomes")
 * @ORM\Entity
 */
class AssessmentToolContributeOutcomes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_assessment_tool_contribute_outcome",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idAssessmentToolContributeOutcomes;

    /**
     * @var AssessmentTool
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AssessmentTool", inversedBy="assessmentToolContributeOutcomes")
     * @ORM\JoinColumn(name="tool_assessment_id", referencedColumnName="id_assessment_tool")
     */
    private $assessmentTool;

    /**
     * @var Outcome
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Outcome", inversedBy="assessmentToolContributeOutcomes")
     * @ORM\JoinColumn(name="outcome_id", referencedColumnName="id_outcome")
     */
    private $outcomeOutcome;


}
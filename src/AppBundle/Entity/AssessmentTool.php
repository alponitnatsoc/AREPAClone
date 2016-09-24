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
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Outcome", inversedBy="assessmentTools")
     * @ORM\JoinTable(name="assessment_tool_contributes_outcome",
     *      joinColumns={@ORM\JoinColumn(name="assessment_tool_id",referencedColumnName="id_assessment_tool")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="outcome_id",referencedColumnName="id_outcome")}
     * )
     */
    private $outcomeOutcome;

    /**
     * @ORM\Column(name='percentage_grade', type="float")
     */
    private $percentageGrade = 0.0;


    private $rubricHasAssessmentTools;



}
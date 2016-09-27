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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Content",mappedBy="rubricHasAssesmentTool")
     */
    private $contents;

    /**
     * @var Rubric
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Rubric",inversedBy="rubricHasAssessmentTools")
     * @ORM\JoinColumn(name="rubric_id", referencedColumnName="id_rubric")
     */
    private $rubricRubric;

    /**
     * @var AssessmentTool
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AssessmentTool", inversedBy="rubricHasAssessmentTools")
     * @ORM\JoinColumn(name="assessment_tool_id",referencedColumnName="id_assessment_tool")
     */
    private $assessmentToolassessmentTools;

}
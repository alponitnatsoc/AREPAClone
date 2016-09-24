<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 24/09/16
 * Time: 03:11 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class Content
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="content")
 * @ORM\Entity
 */
class Content
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_content",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idContent;

    /**
     * @ORM\Column(name='percentage_grade', type="float")
     */
    private $percentageGrade=0.0;

    /**
     * @ORM\Column(name='percentage_grade', type="float")
     */
    private $percentageAssessmentTool=0.0;

    /**
     * @var boolean
     */
    private $contributeOutcome;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\RubricHasAssessmentTool", inversedBy="contents", cascade={"persist"})
     * @ORM\JoinColumn(name="rubric_has_assessment_tool_id", referencedColumnName="id_rubric_has_assessment_tool")
     */
    private $rubricHasAssesmentTool;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ContentAportsOutcome", mappedBy="contentContent")
     */
    private $contentAportsoutcomes;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ContentGrade", mappedBy="contentContent")
     */
    private $contentGrades;

}
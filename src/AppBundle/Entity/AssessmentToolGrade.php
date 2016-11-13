<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 17/09/16
 * Time: 04:59 PM
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class AssessmentToolGrade
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="assessment_tool_grade")
 * @ORM\Entity
 */
class AssessmentToolGrade
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id_assessment_tool_grade",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idAssessmentToolGrade;

    /**
     * @var   AssessmentTool
     *
     * @ORM\ManyToOne(targetEntity="AssessmentTool", inversedBy="assessmentToolGrade")
     * @ORM\JoinColumns({@ORM\JoinColumn(name="id_assessment", referencedColumnName="id_assessment_tool")})
     */
    private $assessmentTool;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ContentGrade", mappedBy="assessmentToolGrade", cascade={"persist", "remove"})
     */
    private $contentGrade;

    /**
     * @var   StudentAssistClass
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\StudentAssistClass", inversedBy="assessmentToolGrades")
     * @ORM\JoinColumns({@ORM\JoinColumn(name="student_assist_class_id", referencedColumnName="id_student_assist_class")})
     */
    private $studentAssistClass;

    /**
     * @var string
     * @ORM\Column(name="document", type="string")
     */
    private $document;


}
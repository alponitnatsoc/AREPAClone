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


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contentGrade = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get idAssessmentToolGrade
     *
     * @return integer
     */
    public function getIdAssessmentToolGrade()
    {
        return $this->idAssessmentToolGrade;
    }

    /**
     * Set document
     *
     * @param string $document
     *
     * @return AssessmentToolGrade
     */
    public function setDocument($document)
    {
        $this->document = $document;

        return $this;
    }

    /**
     * Get document
     *
     * @return string
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * Set assessmentTool
     *
     * @param \AppBundle\Entity\AssessmentTool $assessmentTool
     *
     * @return AssessmentToolGrade
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

    /**
     * Add contentGrade
     *
     * @param \AppBundle\Entity\ContentGrade $contentGrade
     *
     * @return AssessmentToolGrade
     */
    public function addContentGrade(\AppBundle\Entity\ContentGrade $contentGrade)
    {
        $this->contentGrade[] = $contentGrade;

        return $this;
    }

    /**
     * Remove contentGrade
     *
     * @param \AppBundle\Entity\ContentGrade $contentGrade
     */
    public function removeContentGrade(\AppBundle\Entity\ContentGrade $contentGrade)
    {
        $this->contentGrade->removeElement($contentGrade);
    }

    /**
     * Get contentGrade
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContentGrade()
    {
        return $this->contentGrade;
    }

    /**
     * Set studentAssistClass
     *
     * @param \AppBundle\Entity\StudentAssistClass $studentAssistClass
     *
     * @return AssessmentToolGrade
     */
    public function setStudentAssistClass(\AppBundle\Entity\StudentAssistClass $studentAssistClass = null)
    {
        $this->studentAssistClass = $studentAssistClass;

        return $this;
    }

    /**
     * Get studentAssistClass
     *
     * @return \AppBundle\Entity\StudentAssistClass
     */
    public function getStudentAssistClass()
    {
        return $this->studentAssistClass;
    }
}

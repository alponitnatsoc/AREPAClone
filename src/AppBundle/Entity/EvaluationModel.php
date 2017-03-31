<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 1/03/17
 * Time: 02:06 AM
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class EvaluationModel
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="evaluation_model",
 *      uniqueConstraints={
 *          @UniqueConstraint(
 *              name="unique_course_period", columns={"active_period","course_id"}
 *          )}
 * )
 * @ORM\Entity()
 */
class EvaluationModel
{

    /**
     * @var integer
     * @ORM\Column(name="id_evaluation_model",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idEvaluationModel;

    /**
     * @var string
     * @ORM\Column(name="active_period",type="string",nullable=TRUE)
     */
    private $activePeriod;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Teacher", inversedBy="evaluationModels", cascade={"persist"})
     * @ORM\JoinColumn(name="role_id",referencedColumnName="id_role", nullable=TRUE)
     */
    private $owner;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Course", inversedBy="evaluationModels", cascade={"persist"})
     * @ORM\JoinColumn(name="course_id",referencedColumnName="id_course", nullable=TRUE)
     */
    private $course;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\AssessmentComponent", cascade={"persist"})
     * @ORM\JoinColumn(name="assessment_component_id",referencedColumnName="id_assessment_component")
     */
    private $assessmentComponent;

    /**
     * EvaluationModel constructor.
     * @param Teacher|null $owner
     * @param Course|null $course
     * @param AssessmentComponent|null $assessmentComponent
     */
    public function __construct(Teacher $owner = null, Course $course = null, AssessmentComponent $assessmentComponent = null)
    {
        $this->owner = $owner;
        $this->course = $course;
        $this->assessmentComponent = $assessmentComponent;
    }

    /**
     * Get idEvaluationModel
     *
     * @return integer
     */
    public function getIdEvaluationModel()
    {
        return $this->idEvaluationModel;
    }

    /**
     * Set owner
     *
     * @param \AppBundle\Entity\Teacher $owner
     *
     * @return EvaluationModel
     */
    public function setOwner(\AppBundle\Entity\Teacher $owner = null)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return \AppBundle\Entity\Teacher
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set course
     *
     * @param \AppBundle\Entity\Course $course
     *
     * @return EvaluationModel
     */
    public function setCourse(\AppBundle\Entity\Course $course = null)
    {
        $this->course = $course;

        return $this;
    }

    /**
     * Get course
     *
     * @return \AppBundle\Entity\Course
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * Set assessmentComponent
     *
     * @param \AppBundle\Entity\AssessmentComponent $assessmentComponent
     *
     * @return EvaluationModel
     */
    public function setAssessmentComponent(\AppBundle\Entity\AssessmentComponent $assessmentComponent = null)
    {
        $this->assessmentComponent = $assessmentComponent;

        return $this;
    }

    /**
     * Get assessmentComponent
     *
     * @return \AppBundle\Entity\AssessmentComponent
     */
    public function getAssessmentComponent()
    {
        return $this->assessmentComponent;
    }

    /**
     * Set activePeriod
     *
     * @param string $activePeriod
     *
     * @return EvaluationModel
     */
    public function setActivePeriod($activePeriod)
    {
        $this->activePeriod = $activePeriod;

        return $this;
    }

    /**
     * Get activePeriod
     *
     * @return string
     */
    public function getActivePeriod()
    {
        return $this->activePeriod;
    }
}

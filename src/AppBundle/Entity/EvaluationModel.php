<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 1/03/17
 * Time: 02:06 AM
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class EvaluationModel
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="evaluation_model")
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
     * @var integer
     * @ORM\Column(name="owner",type="integer",nullable=TRUE)
     */
    private $owner;

    /**
     * @var integer
     * @ORM\Column(name="course",type="integer",nullable=TRUE)
     */
    private $course;

    /**
     * @var integer
     * @ORM\Column(name="class_course",type="integer",nullable=TRUE)
     */
    private $classCourse;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\AssessmentComponent", cascade={"persist"})
     * @ORM\JoinColumn(name="assessment_tool_id",referencedColumnName="id_assessment_component")
     */
    private $assessmentTool;

}
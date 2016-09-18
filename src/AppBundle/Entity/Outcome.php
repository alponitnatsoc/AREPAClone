<?php
/**
 * Created by PhpStorm.
 * User: erikaxu
 * Date: 14/09/16
 * Time: 06:57 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class Outcome
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="outcome",
 *     uniqueConstraints={
 *          @UniqueConstraint(
 *              name="personStudentUnique", columns={"name_outcome"}
 *          )
 *     })
 * @ORM\Entity
 */
class Outcome
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id_outcome",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idOutcome;

    /**
     * @var string
     *
     * @ORM\Column(name="name_outcome",type="string", length=10)
     */
    private $nameOutcome;

    /**
     * @var string
     *
     * @ORM\Column(name="description_outcome",type="string", length=300)
     */
    private $descriptionOutcome;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\AssessmentTool",mappedBy="outcomeOutcome")
     */
    private $assessmentTools;
}

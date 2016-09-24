<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 24/09/16
 * Time: 05:46 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ContentAportsOutcome
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="content_aports_outcome")
 * @ORM\Entity
 */
class ContentAportsOutcome
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_content_aports_outcome",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idContentAportsOutcome;

    /**
     * @var string
     * @ORM\Column(name="below_standard",type="string", length=1000)
     */
    private $belowStandard;

    /**
     * @var string
     * @ORM\Column(name="below_standard",type="string", length=1000)
     */
    private $competent;

    /**
     * @var string
     * @ORM\Column(name="below_standard",type="string", length=1000)
     */
    private $exemplary;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Content", inversedBy="contentAportsoutcomes")
     * @ORM\JoinColumn(name="content_id", referencedColumnName="id_content")
     */
    private $contentContent;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Outcome", inversedBy="contentAportsOutcome")
     * @ORM\JoinColumn(name="outcome_id", referencedColumnName="id_outcome")
     */
    private $outcomeoutcome;

}
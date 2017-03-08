<?php
/**
 * Created by PhpStorm.
 * User: andres
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
 *              name="outcomeUnique", columns={"name_outcome"}
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
     * @ORM\Column(name="name",type="string")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description_spanish",length=20000,type="text",nullable=true)
     */
    private $descriptionSpanish;

    /**
     * @var string
     *
     * @ORM\Column(name="description_english",length=20000,type="text",nullable=true)
     */
    private $descriptionEnglish;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\CourseContributesOutcome", mappedBy="outcome", cascade={"persist", "remove"})
     */
    private $courseContributesOutcome;

    /**
     * ToString
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }

}

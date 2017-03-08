<?php
/**
 * Created by PhpStorm.
 * User: andresfelipe
 * Date: 10/20/16
 * Time: 7:57 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;


/**
 * Class Section
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="section",
 *     uniqueConstraints={
 *          @UniqueConstraint(
 *              name="codeSectionUnique", columns={"section_code"}
 *          )
 *     })
 * @ORM\Entity
 */
class Section
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_section",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idSection;

    /**
     * @var string
     *
     * @ORM\Column(name="section_code",type="string", length=8, nullable=true, unique=true)
     */
    private $sectionCode;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Course", mappedBy="section", cascade={"persist", "remove"})
     */
    private $courses;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Faculty", inversedBy="sections", cascade={"persist"})
     * @ORM\JoinColumn(name="faculty_id", referencedColumnName="id_faculty")
     */
    private $faculty;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Teacher",mappedBy="section", cascade={"persist"})
     * @ORM\Column(name="section_chief",unique=TRUE,nullable=TRUE)
     */
    private $sectionChief;

}

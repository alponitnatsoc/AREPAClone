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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\SectionHasCourse", mappedBy="sectionSection", cascade={"persist", "remove"})
     */
    private $sectionHasCourses;


}

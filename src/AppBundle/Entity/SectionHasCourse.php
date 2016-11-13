<?php
/**
 * Created by PhpStorm.
 * User: andresfelipe
 * Date: 10/21/16
 * Time: 9:25 AM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class Section
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="section_has_course",
 *     indexes={
 *              @ORM\Index(name="fk_section_has_course",columns={"section_id"}),
 *              @ORM\Index(name="fk_course_has_section",columns={"course_id"})
 *     },
 *     uniqueConstraints={
 *              @UniqueConstraint(name="uniqueSectionCourse",columns={"section_id","course_id"},
 *              options={"where":"(((id_section_has_course IS NOT NULL) AND (course_id IS NULL) AND (section_id IS NULL)))"})
 *     }
 * )
 * @ORM\Entity
 */
class SectionHasCourse
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_section_has_course",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idSectionHasCourse;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Section",inversedBy="sectionHasCourses",cascade={"persist"})
     * @ORM\JoinColumns(@ORM\JoinColumn(name="section_id",referencedColumnName="id_section"))
     */
    private $sectionSection;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Course",inversedBy="courseHasSection",cascade={"persist"})
     * @ORM\JoinColumns(@ORM\JoinColumn(name="course_id",referencedColumnName="id_course"))
     */
    private $courseCourse;

    /**
     * Get idSectionHasCourse
     *
     * @return integer
     */
    public function getIdSectionHasCourse()
    {
        return $this->idSectionHasCourse;
    }

    /**
     * Set sectionSection
     *
     * @param \AppBundle\Entity\Section $sectionSection
     *
     * @return SectionHasCourse
     */
    public function setSectionSection(\AppBundle\Entity\Section $sectionSection = null)
    {
        $this->sectionSection = $sectionSection;

        return $this;
    }

    /**
     * Get sectionSection
     *
     * @return \AppBundle\Entity\Section
     */
    public function getSectionSection()
    {
        return $this->sectionSection;
    }

    /**
     * Set courseCourse
     *
     * @param \AppBundle\Entity\Course $courseCourse
     *
     * @return SectionHasCourse
     */
    public function setCourseCourse(\AppBundle\Entity\Course $courseCourse = null)
    {
        $this->courseCourse = $courseCourse;

        return $this;
    }

    /**
     * Get courseCourse
     *
     * @return \AppBundle\Entity\Course
     */
    public function getCourseCourse()
    {
        return $this->courseCourse;
    }
}

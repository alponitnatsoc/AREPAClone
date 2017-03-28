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


    /**
     * Section constructor.
     * @param string|null $sectionCode
     * @param Faculty|null $faculty
     * @param Teacher|null $sectionChief
     */
    public function __construct($sectionCode = null, Faculty $faculty = null, Teacher $sectionChief = null )
    {
        $this->sectionCode = $sectionCode;
        $this->faculty = $faculty;
        $this->sectionChief = $sectionChief;
        $this->courses = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get idSection
     *
     * @return integer
     */
    public function getIdSection()
    {
        return $this->idSection;
    }

    /**
     * Set sectionCode
     *
     * @param string $sectionCode
     *
     * @return Section
     */
    public function setSectionCode($sectionCode)
    {
        $this->sectionCode = $sectionCode;

        return $this;
    }

    /**
     * Get sectionCode
     *
     * @return string
     */
    public function getSectionCode()
    {
        return $this->sectionCode;
    }

    /**
     * Set sectionChief
     *
     * @param string $sectionChief
     *
     * @return Section
     */
    public function setSectionChief($sectionChief)
    {
        $this->sectionChief = $sectionChief;

        return $this;
    }

    /**
     * Get sectionChief
     *
     * @return string
     */
    public function getSectionChief()
    {
        return $this->sectionChief;
    }

    /**
     * Add course
     *
     * @param \AppBundle\Entity\Course $course
     *
     * @return Section
     */
    public function addCourse(\AppBundle\Entity\Course $course)
    {
        if($course->getSection()!= $this)$course->setSection($this);
        $this->courses[] = $course;
        return $this;
    }

    /**
     * Remove course
     *
     * @param \AppBundle\Entity\Course $course
     */
    public function removeCourse(\AppBundle\Entity\Course $course)
    {
        $this->courses->removeElement($course);
    }

    /**
     * Get courses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCourses()
    {
        return $this->courses;
    }

    /**
     * Set faculty
     *
     * @param \AppBundle\Entity\Faculty $faculty
     *
     * @return Section
     */
    public function setFaculty(\AppBundle\Entity\Faculty $faculty = null)
    {
        $this->faculty = $faculty;

        return $this;
    }

    /**
     * Get faculty
     *
     * @return \AppBundle\Entity\Faculty
     */
    public function getFaculty()
    {
        return $this->faculty;
    }
}

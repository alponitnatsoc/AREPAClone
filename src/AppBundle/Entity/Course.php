<?php
/**
 * Created by PhpStorm.
 * User: erikaxu
 * Date: 14/09/16
 * Time: 12:05 PM
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;


/**
 * Class Course
 * @package AppBundle\Entity
 *
 *@ORM\Table(name="course",
 *     uniqueConstraints={
 *          @UniqueConstraint(
 *              name="codeCourseUnique", columns={"course_code"}
 *          )
 *     })
 * @ORM\Entity
 */
Class Course{


    /**
     * @var integer
     *
     * @ORM\Column(name="id_course",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idCourse;

    /**
     * @var string
     *
     * @ORM\Column(name="course_code",type="string", length=8, nullable=true)
     */
    private $courseCode;

    /**
     * @var integer
     *
     * @ORM\Column(name="credits",type="integer",nullable=true)
     */
    private $credits;

    /**
     * @var string
     *
     * @ORM\Column(name="name_course",type="string", length=150,nullable=true)
     */
    private $nameCourse;

    /**
     * @var string
     *
     * @ORM\Column(name="id_description",type="string", length=300,nullable=true)
     */
    private $description;

    /**
     * @var ClassCourse
     * @ORM\OneToMany(targetEntity="ClassCourse", mappedBy="idclass", cascade={"persist"})
     */
    private $classes;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->classes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get idCourse
     *
     * @return integer
     */
    public function getIdCourse()
    {
        return $this->idCourse;
    }

    /**
     * Set courseCode
     *
     * @param string $courseCode
     *
     * @return Course
     */
    public function setCourseCode($courseCode)
    {
        $this->courseCode = $courseCode;

        return $this;
    }

    /**
     * Get courseCode
     *
     * @return string
     */
    public function getCourseCode()
    {
        return $this->courseCode;
    }

    /**
     * Set credits
     *
     * @param integer $credits
     *
     * @return Course
     */
    public function setCredits($credits)
    {
        $this->credits = $credits;

        return $this;
    }

    /**
     * Get credits
     *
     * @return integer
     */
    public function getCredits()
    {
        return $this->credits;
    }

    /**
     * Set nameCourse
     *
     * @param string $nameCourse
     *
     * @return Course
     */
    public function setNameCourse($nameCourse)
    {
        $this->nameCourse = $nameCourse;

        return $this;
    }

    /**
     * Get nameCourse
     *
     * @return string
     */
    public function getNameCourse()
    {
        return $this->nameCourse;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Course
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add class
     *
     * @param \AppBundle\Entity\ClassCourse $class
     *
     * @return Course
     */
    public function addClass(\AppBundle\Entity\ClassCourse $class)
    {
        $this->classes[] = $class;

        return $this;
    }

    /**
     * Remove class
     *
     * @param \AppBundle\Entity\ClassCourse $class
     */
    public function removeClass(\AppBundle\Entity\ClassCourse $class)
    {
        $this->classes->removeElement($class);
    }

    /**
     * Get classes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClasses()
    {
        return $this->classes;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 13/09/16
 * Time: 09:18 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Person
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="person")
 * @ORM\Entity
 */
class Person
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_person",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idPerson;

    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $secondName;

    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $lasteName1;

    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $lastName2;

    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $documento;

    /**
     * @var Student
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Student", mappedBy="idStudent", cascade={"persist"})
     */
    private $student;

    /**
     * @var Teacher
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Student", mappedBy="idTeacher", cascade={"persist"})
     */
    private $teacher;


    /**
     * Get idPerson
     *
     * @return integer
     */
    public function getIdPerson()
    {
        return $this->idPerson;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Person
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set secondName
     *
     * @param string $secondName
     *
     * @return Person
     */
    public function setSecondName($secondName)
    {
        $this->secondName = $secondName;

        return $this;
    }

    /**
     * Get secondName
     *
     * @return string
     */
    public function getSecondName()
    {
        return $this->secondName;
    }

    /**
     * Set lasteName1
     *
     * @param string $lasteName1
     *
     * @return Person
     */
    public function setLasteName1($lasteName1)
    {
        $this->lasteName1 = $lasteName1;

        return $this;
    }

    /**
     * Get lasteName1
     *
     * @return string
     */
    public function getLasteName1()
    {
        return $this->lasteName1;
    }

    /**
     * Set lastName2
     *
     * @param string $lastName2
     *
     * @return Person
     */
    public function setLastName2($lastName2)
    {
        $this->lastName2 = $lastName2;

        return $this;
    }

    /**
     * Get lastName2
     *
     * @return string
     */
    public function getLastName2()
    {
        return $this->lastName2;
    }

    /**
     * Set documento
     *
     * @param string $documento
     *
     * @return Person
     */
    public function setDocumento($documento)
    {
        $this->documento = $documento;

        return $this;
    }

    /**
     * Get documento
     *
     * @return string
     */
    public function getDocumento()
    {
        return $this->documento;
    }

    /**
     * Set studentStudent
     *
     * @param \AppBundle\Entity\Student $studentStudent
     *
     * @return Person
     */
    public function setStudentStudent(\AppBundle\Entity\Student $studentStudent = null)
    {
        $this->studentStudent = $studentStudent;

        return $this;
    }

    /**
     * Get studentStudent
     *
     * @return \AppBundle\Entity\Student
     */
    public function getStudentStudent()
    {
        return $this->studentStudent;
    }

    /**
     * Set student
     *
     * @param \AppBundle\Entity\Student $student
     *
     * @return Person
     */
    public function setStudent(\AppBundle\Entity\Student $student = null)
    {
        $this->student = $student;

        return $this;
    }

    /**
     * Get student
     *
     * @return \AppBundle\Entity\Student
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * Set teacher
     *
     * @param \AppBundle\Entity\Student $teacher
     *
     * @return Person
     */
    public function setTeacher(\AppBundle\Entity\Student $teacher = null)
    {
        $this->teacher = $teacher;

        return $this;
    }

    /**
     * Get teacher
     *
     * @return \AppBundle\Entity\Student
     */
    public function getTeacher()
    {
        return $this->teacher;
    }
}

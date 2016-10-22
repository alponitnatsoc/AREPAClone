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
     * @var string
     * @ORM\Column(type="string",nullable=true)
     */
    private $firstName;

    /**
     * @var string
     * @ORM\Column(type="string",nullable=true)
     */
    private $secondName;

    /**
     * @var string
     * @ORM\Column(type="string",nullable=true)
     */
    private $lastName1;

    /**
     * @var string
     * @ORM\Column(type="string",nullable=true)
     */
    private $lastName2;

    /**
     * @var string
     * @ORM\Column(name="document_type", type="string", length=2, nullable=true)
     */
    private $documentType;

    /**
     * @var string
     * @ORM\Column(type="string",nullable=true)
     */
    private $document;

    /**
     * @var Student
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Student", mappedBy="personPerson", cascade={"persist","remove"})
     * @ORM\JoinColumn(name="student_id",referencedColumnName="id_student",nullable=true)
     */
    private $student;

    /**
     * @var Teacher
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Teacher", mappedBy="personPerson", cascade={"persist","remove"})
     * @ORM\JoinColumn(name="teacher_id",referencedColumnName="id_teacher",nullable=true)
     */
    private $teacher;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PersonNotification", mappedBy="personPerson", cascade={"persist", "remove"})
     */
    private $personNotification;

    //TODO
    /**
     * @var string
     */
    private $userUser;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->personNotification = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get FullName
     *
     * @return string
     */
    public function getFullName()
    {
        $fullName = '';
        if($this->firstName!=''){
            $fullName .=$this->firstName;
        }
        if($this->secondName!=''){
            if($fullName!=''){
                $fullName .=' '.$this->secondName;
            }else{
                $fullName .=$this->secondName;
            }
        }
        if($this->lastName1!=''){
            if($fullName!=''){
                $fullName .=' '.$this->lastName1;
            }else{
                $fullName .=$this->lastName1;
            }
        }
        if($this->lastName2!=''){
            $fullName .=$this->lastName2;
        }
        return $fullName;
    }


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
     * Set lastName1
     *
     * @param string $lastName1
     *
     * @return Person
     */
    public function setLastName1($lastName1)
    {
        $this->lastName1 = $lastName1;

        return $this;
    }

    /**
     * Get lastName1
     *
     * @return string
     */
    public function getLastName1()
    {
        return $this->lastName1;
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
     * Set documentType
     *
     * @param string $documentType
     *
     * @return Person
     */
    public function setDocumentType($documentType)
    {
        $this->documentType = $documentType;

        return $this;
    }

    /**
     * Get documentType
     *
     * @return string
     */
    public function getDocumentType()
    {
        return $this->documentType;
    }

    /**
     * Set document
     *
     * @param string $document
     *
     * @return Person
     */
    public function setDocument($document)
    {
        $this->document = $document;

        return $this;
    }

    /**
     * Get document
     *
     * @return string
     */
    public function getDocument()
    {
        return $this->document;
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
     * @param \AppBundle\Entity\Teacher $teacher
     *
     * @return Person
     */
    public function setTeacher(\AppBundle\Entity\Teacher $teacher = null)
    {
        $this->teacher = $teacher;

        return $this;
    }

    /**
     * Get teacher
     *
     * @return \AppBundle\Entity\Teacher
     */
    public function getTeacher()
    {
        return $this->teacher;
    }

    /**
     * Add personNotification
     *
     * @param \AppBundle\Entity\PersonNotification $personNotification
     *
     * @return Person
     */
    public function addPersonNotification(\AppBundle\Entity\PersonNotification $personNotification)
    {
        $this->personNotification[] = $personNotification;

        return $this;
    }

    /**
     * Remove personNotification
     *
     * @param \AppBundle\Entity\PersonNotification $personNotification
     */
    public function removePersonNotification(\AppBundle\Entity\PersonNotification $personNotification)
    {
        $this->personNotification->removeElement($personNotification);
    }

    /**
     * Get personNotification
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPersonNotification()
    {
        return $this->personNotification;
    }
}

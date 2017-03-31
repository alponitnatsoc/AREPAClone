<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 13/09/16
 * Time: 09:18 PM
 */

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Person
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="person",
 *      uniqueConstraints={
 *          @UniqueConstraint(
 *              name="person_document_unique", columns={"document_type","document"}
 *          ),@UniqueConstraint(
 *              name="people_soft_email_unique", columns={"people_soft_email"}
 *          ),@UniqueConstraint(
 *              name="people_soft_user_name_unique", columns={"people_soft_user_name"}
 *          )
 *     })
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

    /** @ORM\Column(name="people_soft_email",type="string",nullable=true) */
    private $peopleSoftEmail;

    /** @ORM\Column(name="people_soft_user_name",type="string",nullable=true) */
    private $peopleSoftUserName;

    /** @ORM\Column(name="phone",type="string",nullable=true) */
    private $phone;

    /** @ORM\Column(name="gender",type="string",length=1,nullable=true) */
    private $gender;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User", inversedBy="personPerson",cascade={"persist"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", unique=TRUE)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Role",mappedBy="person", cascade={"persist"})
     */
    private $personRole;

    /**
     * Get FullName
     *  returns the names and the last names of the person
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
            $fullName .=' '.$this->lastName2;
        }
        return $fullName;
    }

    /**
     * returns the full last name of the person
     * @return string
     */
    public function getFullLastName()
    {
        $fullLastName = '';
        if( $this->lastName1 !=''){
            $fullLastName .= $this->lastName1;
        }
        if($this->lastName2!=''){
            $fullLastName .=' '.$this->lastName2;
        }
        return $fullLastName;
    }

    /**
     * return the full name of the person
     * @return string
     */
    public function getNames()
    {
        $names = '';
        if( $this->firstName !=''){
            $names .= $this->firstName;
        }
        if($this->secondName!=''){
            $names .=' '.$this->secondName;
        }
        return $names;
    }


    public function __toString()
    {
        return $this->getFullName();
    }

    /**
     * like toString method but with document type and document number
     * @return string
     */
    public function getInfo()
    {
        return $this->getFullLastName().', '.$this->getNames().". ".$this->getDocumentType()." ".$this->getDocument();
    }

    /**
     * Constructor
     * @param string $firstName
     * @param string $secondName
     * @param string $lastName1
     * @param string $lastName2
     * @param string $documentType
     * @param string $document
     * @param string $peopleSoftEmail
     * @param string $peopleSoftUserName
     * @param string $phone
     * @param string $gender
     * @param User $user
     * @param ArrayCollection $personRoles
     */
    public function __construct($firstName = null, $secondName = null, $lastName1 = null, $lastName2 = null, $documentType = null,
                                $document = null, $peopleSoftEmail = null, $peopleSoftUserName = null, $phone = null, $gender = null, User $user = null, ArrayCollection $personRoles = null)
    {
        $this->firstName = $firstName;
        $this->secondName = $secondName;
        $this->lastName1 = $lastName1;
        $this->lastName2 = $lastName2;
        $this->documentType = $documentType;
        $this->document = $document;
        $this->peopleSoftEmail = $peopleSoftEmail;
        $this->peopleSoftUserName = $peopleSoftUserName;
        $this->phone = $phone;
        $this->gender = $gender;
        $this->user = $user;
        $this->personRole = ($personRoles!= null) ? $personRoles : new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set peopleSoftEmail
     *
     * @param string $peopleSoftEmail
     *
     * @return Person
     */
    public function setPeopleSoftEmail($peopleSoftEmail)
    {
        $this->peopleSoftEmail = $peopleSoftEmail;

        return $this;
    }

    /**
     * Get peopleSoftEmail
     *
     * @return string
     */
    public function getPeopleSoftEmail()
    {
        return $this->peopleSoftEmail;
    }

    /**
     * Set peopleSoftUserName
     *
     * @param string $peopleSoftUserName
     *
     * @return Person
     */
    public function setPeopleSoftUserName($peopleSoftUserName)
    {
        $this->peopleSoftUserName = $peopleSoftUserName;

        return $this;
    }

    /**
     * Get peopleSoftUserName
     *
     * @return string
     */
    public function getPeopleSoftUserName()
    {
        return $this->peopleSoftUserName;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Person
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return Person
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Person
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }


    /**
     * @param Role $personRole
     * @return $this
     * @throws \Exception when person already has the role
     */
    public function addPersonRole(\AppBundle\Entity\Role $personRole)
    {
        if($personRole instanceof Student and $this->isStudent()) {
            throw new \Exception("This person already has one role Student",101);
        }elseif ($personRole instanceof Teacher and $this->isTeacher()) {
            throw new \Exception("This person already has one role Teacher",101);
        }elseif ($personRole instanceof TeacherAssistant and $this->isTeacherAssistant()) {
            throw new \Exception("This person already has one role TeacherAssistant",101);
        }
        if($personRole->getPerson()==null){
            $personRole->setPerson($this);
        }
        $this->personRole[]= $personRole;
        return $this;
    }

    /**
     * Remove personRole
     *
     * @param \AppBundle\Entity\Role $personRole
     */
    public function removePersonRole(\AppBundle\Entity\Role $personRole)
    {
        $personRole->setPerson(null);
        $this->personRole->removeElement($personRole);
    }

    /**
     * Get personRole
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPersonRole()
    {
        return $this->personRole;
    }

    /**
     * is student
     * return true if the person has one role Student
     *
     * @return bool
     */
    public function isStudent()
    {
        return ($this->personRole->filter(function($role){return $role->getClass()=='Student';})->count()>0)?true:false;
    }

    /**
     * is teacher
     * return true if the person has one role Teacher
     * @return bool
     */
    public function isTeacher()
    {
        return ($this->personRole->filter(function($role){return $role->getClass()=='Teacher';})->count()>0)?true:false;
    }

    /**
     * is teacher assistant
     * return true if the person has one role TeacherAssistant
     *
     * @return bool
     */
    public function isTeacherAssistant()
    {
        return ($this->personRole->filter(function($role){return $role->getClass()=='teacherAssistant';})->count()>0)?true:false;
    }

    /**
     * if person has one student returns the Student else returns null
     * @return Student
     */
    public function getStudent()
    {
        return ($this->isStudent())?$this->personRole->filter(function($role){return $role->getClass()=='Student';})->first():null;
    }

    /**
     * if person has one teacher returns the Teacher else returns null
     * @return Teacher
     */
    public function getTeacher()
    {
        return ($this->isTeacher())?$this->personRole->filter(function($role){return $role->getClass()=='Teacher';})->first():null;
    }

    /**
     * if person has one teacher assistant returns the TeacherAssistant else returns null
     * @return Teacher
     */
    public function getTeacherAssistant()
    {
        return ($this->isTeacherAssistant())?$this->personRole->filter(function($role){return $role->getClass()=='TeacherAssistant';})->first():null;
    }
}

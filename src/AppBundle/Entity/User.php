<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 1/10/16
 * Time: 10:31 AM
 */

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 * @package AppBundle\Entity
 * @ORM\Table(name="user")
 * @ORM\Entity()
 */
class User extends BaseUser
{
    /**
     * @var integer
     * @ORM\Column(name="id",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Person", cascade={"persist"})
     * @ORM\JoinColumn(name="person_id_person", referencedColumnName="id_person")
     */
    private $personPerson;

    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Set personPerson
     *
     * @param \AppBundle\Entity\Person $personPerson
     *
     * @return User
     */
    public function setPersonPerson(\AppBundle\Entity\Person $personPerson = null)
    {
        $this->personPerson = $personPerson;

        return $this;
    }

    /**
     * Get personPerson
     *
     * @return \AppBundle\Entity\Person
     */
    public function getPersonPerson()
    {
        return $this->personPerson;
    }
}

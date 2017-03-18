<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 13/09/16
 * Time: 09:55 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class TeacherAssistant
 * @package AppBundle\Entity
 *
 * @ORM\Entity()
 */

class TeacherAssistant extends Role
{
    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getClass()." ".$this->getStudentCode();
    }

    /**
     * Student constructor.
     * @param Person|null $person
     */
    public function __construct(Person $person = null)
    {
        parent::__construct($person);

    }

    /**
     * get class
     * returns the name of the class
     * @return string
     */
    public function getClass(){
        $path = explode('\\', __CLASS__);
        return array_pop($path);
    }
}

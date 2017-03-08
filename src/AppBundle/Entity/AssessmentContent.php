<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 1/03/17
 * Time: 02:11 AM
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class AssessmentContent
 * @package AppBundle\Entity
 *
 * @ORM\Entity()
 */
class AssessmentContent extends AssessmentComponent
{

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

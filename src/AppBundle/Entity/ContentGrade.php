<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 24/09/16
 * Time: 06:01 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Class ContentGrade
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="content_grade")
 * @ORM\Entity
 */
class ContentGrade
{
    /**
     * @var integer
     * @ORM\Column(name="id_content_grade",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idContentGrade;

    /**
     * @var float
     * @ORM\Column(name="grade", type="float")
     */
    private $grade=0.0;


    private $contentContent;

    private $assessmentToolGrade;

}
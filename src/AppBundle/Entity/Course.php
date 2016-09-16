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
}

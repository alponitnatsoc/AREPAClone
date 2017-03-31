<?php
/**
 * Created by PhpStorm.
 * User: erika
 * Date: 14/11/16
 * Time: 03:13 PM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\ClassCourse;
use AppBundle\Entity\CourseContributesOutcome;
use AppBundle\Entity\Faculty;
use AppBundle\Entity\StudentAssistClass;
use AppBundle\Entity\Period;
use AppBundle\Entity\Person;
use AppBundle\Entity\Teacher;
use AppBundle\Entity\User;
use AppBundle\Form\addDocument;
use Doctrine\DBAL\Types\StringType;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\NotBlank;

class StudentController extends Controller
{

    public function studentDashboardAction($active, Request $request)
    {
        if ($this->isGranted('ROLE_STUDENT')) {


            $em = $this->getDoctrine()->getManager();
            /** @var Plataform $plataform */
            $plataform = $em->getRepository("AppBundle:Platform")->find(1);
            /** @var User $user */
            $user = $this->getUser();
            /** @var Faculty $faculty , *//*la facultad a la que pertence el estudiante*/
            $faculty = $user->getPersonPerson()->getStudent()->getStudentHasFaculty()->first()->getFacultyFaculty();
            /** @var Teacher $teacher */
            $student = $user->getPersonPerson()->getStudent();


            if(!$active) {
                $query = $em->createQueryBuilder();
                $query->select('sl');
                $query
                    ->from("AppBundle:StudentAssistClass", 'sl')
                    ->join('sl.classCourseClassCourse','cl')
                    ->join('cl.courseCourse', 'c')
                    ->join('cl.classHasStudents', 'cs')
                    ->join('c.courseHasfaculty', 'f')
                    ->where('cl.activePeriod = ?1')
                    /*->andWhere('f.facultyFaculty = ?2')*/
                    ->andwhere('cs.studentStudent= ?3')
                    ->andwhere('sl.studentStudent= cs.studentStudent')
                    ->setParameter('1', $plataform->getActivePeriod())
                    /* ->setParameter('2',$faculty)*/
                    ->setParameter('3', $student);

                $studentAssisstClass = $query->getQuery()->getResult();
            }else{
                $query = $em->createQueryBuilder();
                $query->select('sl');
                $query
                    ->from("AppBundle:StudentAssistClass", 'sl')
                    ->join('sl.classCourseClassCourse','cl')
                    ->join('cl.courseCourse', 'c')
                    ->join('cl.classHasStudents', 'cs')
                    ->join('c.courseHasfaculty', 'f')
                    /*->andWhere('f.facultyFaculty = ?2')*/
                    ->andwhere('cs.studentStudent= ?3')
                    ->andwhere('sl.studentStudent= cs.studentStudent')
                    /* ->setParameter('2',$faculty)*/
                    ->setParameter('3', $student);
                $query->orderBy('cl.activePeriod', 'DESC');
                $studentAssisstClass = $query->getQuery()->getResult();
            }


            return $this->render('@App/Student/student_dashboard.html.twig',array(
                'studentAssisstClass'=>$studentAssisstClass,
                /*'faculty'=>$faculty,*/
                'plataform'=>$plataform,
            ));

        }
        else{
            $this->createAccessDeniedException();
        }
        $this->redirectToRoute('dashboard',array(),307);

    }


}
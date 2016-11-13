<?php
/**
 * Created by PhpStorm.
 * User: erikaxu
 * Date: 22/09/16
 * Time: 03:38 PM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\ClassCourse;
use AppBundle\Entity\Faculty;
use AppBundle\Entity\Period;
use AppBundle\Entity\Plataform;
use AppBundle\Entity\Teacher;
use AppBundle\Entity\TeacherDictatesCourse;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TeacherController extends Controller
{

    public function teacherDashboardAction(Request $request)
    {
        if($this->isGranted('ROLE_TEACHER')){
            $em = $this->getDoctrine()->getManager();
            /** @var Plataform $plataform */
            $plataform = $em->getRepository("AppBundle:Plataform")->find(1);
            /** @var User $user */
            $user = $this->getUser();
            /** @var Faculty $faculty */
            $faculty = $user->getPersonPerson()->getTeacher()->getTeacherHasfaculty()->first()->getFacultyFaculty();
            /** @var Teacher $teacher */
            $teacher = $user->getPersonPerson()->getTeacher();
            $teacher->getTeacherHasRoles();
            $teacherDictatesCourses = $teacher->getTeacherDictatesCourses();
            /** @var TeacherDictatesCourse $lastTC */
            $lastTC = $teacherDictatesCourses->last();
            $activeClass=array();
            $classes = array();
            /** @var TeacherDictatesCourse $tc */
            foreach ($teacherDictatesCourses as $tc) {
                $class = $tc->getClasses();
                /** @var ClassCourse $class */
                foreach ($classes as $class) {
                    if($class->getActivePeriod()==$plataform->getActivePeriod()){
                        $activeClass[]=$class;
                        $classes[]=$class;
                    }else{
                        $classes[]=$class;
                    }
                }
            }

            return $this->render('@App/Teacher/teacher_dashboard.html.twig',array(
                'teacherCourses'=>$teacherDictatesCourses,
                'lastTeacherCourse'=>$lastTC,
            ));
        }else{
            $this->createAccessDeniedException();
        }
        $this->redirectToRoute('dashboard',array(),307);
    }

}
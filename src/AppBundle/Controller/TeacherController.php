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
use AppBundle\Entity\TeacherDictatesClassCourse;
use AppBundle\Entity\TeacherDictatesCourse;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TeacherController extends Controller
{

    public function teacherDashboardAction($type = 0, Request $request)
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
            $activeClass = array();
            $classes = array();
            $activeCourses = array();
            $courses = array();
            /** @var TeacherDictatesCourse $tc */
            foreach ($teacherDictatesCourses as $tc) {
                $courses[]=$tc->getCourseCourse();
                $tdcs = $tc->getClasses();
                /** @var TeacherDictatesClassCourse $tdc */
                foreach ($tdcs as $tdc) {
                    if($tdc->getClassClass()->getActivePeriod()==$plataform->getActivePeriod()){
                        $activeCourses[]=$tc->getCourseCourse();
                        $activeClass[]=$tdc->getClassClass();
                        $classes[]=$tdc->getClassClass();
                    }else{
                        $classes[]=$tdc->getClassClass();
                    }
                }
            }

            switch ($type){
                case 0:
                    return $this->render('@App/Teacher/teacher_dashboard.html.twig',array(
                        'teacherCourses'=>$teacherDictatesCourses,
                        'courses'=>$courses,
                        'activeCourses'=>$activeCourses,
                        'lastTeacherCourse'=>$lastTC,
                        'activeClasses'=>$activeClass,
                        'classes'=>$classes
                    ));
                    break;
                case 1:
                    return $this->render('@App/Teacher/teacher_courses.html.twig',array(
                        'teacherCourses'=>$teacherDictatesCourses,
                        'courses'=>$courses,
                        'activeCourses'=>$activeCourses,
                        'lastTeacherCourse'=>$lastTC,
                        'activeClasses'=>$activeClass,
                        'classes'=>$classes
                    ));
                    break;
                case 2:
                    return $this->render('@App/Teacher/teacher_active_classes.html.twig',array(
                        'teacherCourses'=>$teacherDictatesCourses,
                        'courses'=>$courses,
                        'activeCourses'=>$activeCourses,
                        'lastTeacherCourse'=>$lastTC,
                        'activeClasses'=>$activeClass,
                        'classes'=>$classes
                    ));
                    break;
                case 3:
                    return $this->render('@App/Teacher/teacher_classes.html.twig',array(
                        'teacherCourses'=>$teacherDictatesCourses,
                        'courses'=>$courses,
                        'activeCourses'=>$activeCourses,
                        'lastTeacherCourse'=>$lastTC,
                        'activeClasses'=>$activeClass,
                        'classes'=>$classes
                    ));
                    break;

            }
        }else{
            $this->createAccessDeniedException();
        }
        $this->redirectToRoute('dashboard',array(),307);
    }

}
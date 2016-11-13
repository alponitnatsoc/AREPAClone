<?php
/**
 * Created by PhpStorm.
 * User: erikaxu
 * Date: 22/09/16
 * Time: 03:38 PM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Faculty;
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
            $plataform = $em->getRepository("AppBundle:Plataform")->find(1);
            /** @var User $user */
            $user = $this->getUser();
            /** @var Faculty $faculty */
            $faculty = $user->getPersonPerson()->getTeacher()->getTeacherHasfaculty()->first()->getFacultyFaculty();
            /** @var Teacher $teacher */
            $teacher = $user->getPersonPerson()->getTeacher();
            /** @var TeacherDictatesCourse $teacherDictatesCourses */
            $teacherDictatesCourses = $teacher->getTeacherDictatesCourses();

            return $this->render('@App/Teacher/teacher_dashboard.html.twig',array(
                'teacherCourses'=>$teacherDictatesCourses,
            ));
        }else{
            $this->createAccessDeniedException();
        }
        $this->redirectToRoute('dashboard',array(),307);
    }

}
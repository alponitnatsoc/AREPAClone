<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Course;
use AppBundle\Entity\Faculty;
use AppBundle\Entity\FacultyHasTeachers;
use AppBundle\Entity\User;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends Controller
{
    public function indexAction()
    {
        if($this->isGranted('IS_AUTHENTICATED_FULLY'))
        {
            return $this->redirectToRoute('dashboard',array(),307);
        }else{
            return $this->redirectToRoute('fos_user_security_login',array(),307);
        }
    }

    public function dashboardAction(Request $request)
    {
        if($this->isGranted('IS_AUTHENTICATED_FULLY'))
        {
            if($this->isGranted('ROLE_ADMIN'))
            {
                return $this->redirectToRoute('admin_dasboard',array(),307);
            }
            elseif($this->isGranted('ROLE_TEACHER'))
            {
                return $this->redirectToRoute('teacher_dashboard',array(),307);
            }
            elseif($this->isGranted('ROLE_STUDENT'))
            {
                return $this->redirectToRoute('student_dashboard',array(),307);
            }else{
                return $this->render('@App/Dashboard/dashboard.html.twig');
            }
        }
        else
            {
            return $this->redirectToRoute('fos_user_security_login',array(),307);
        }
    }

    public function studentDashboardAction(Request $request)
    {
        if($this->isGranted('ROLE_STUDENT')){
            return $this->render('@App/Student/student_dashboard.html.twig');
        }else{
            $this->createAccessDeniedException();
        }
        $this->redirectToRoute('dashboard',array(),307);
    }

    public function teacherDashboardAction(Request $request)
    {
        if($this->isGranted('ROLE_TEACHER')){
            return $this->render('@App/Teacher/teacher_dashboard.html.twig');
        }else{
            $this->createAccessDeniedException();
        }
        $this->redirectToRoute('dashboard',array(),307);
    }

    public function adminDashboardAction(Request $request)
    {
        if($this->isGranted('ROLE_ADMIN')){
            $em = $this->getDoctrine()->getManager();
            /** @var User $user */
            $user = $this->getUser();
            /** @var Faculty $faculty */
            $faculty = $user->getPersonPerson()->getTeacher()->getTeacherHasfaculty()->first()->getFacultyFaculty();
            $facultyHasCourses = $faculty->getFacultyHasCourses();
            $facultyHasTeachers = $faculty->getFacultyHasTeacher();
            /** @var QueryBuilder $query */
            $query = $em->createQueryBuilder();
            $query
                ->select('c,MAX(c.createdAt) AS max_score')
                ->from("AppBundle:Course",'c')
                ->groupBy('c.idCourse')
                ->setMaxResults(1)
                ->orderBy('max_score','DESC');
            $query2 = $em->createQueryBuilder();
            $query2
                ->select('t,MAX(t.createdAt) AS max_score')
                ->from("AppBundle:Teacher",'t')
                ->groupBy('t.idTeacher')
                ->setMaxResults(1)
                ->orderBy('max_score','DESC');
            /** @var Course $lastCourse */
            $lastCourse = $query->getQuery()->getResult()[0][0];
            $lastTeacher = $query2->getQuery()->getResult()[0][0];
            return $this->render('@App/Admin/admin_dashboard.html.twig',array(
                'courses'=>$facultyHasCourses,
                'teachers'=>$facultyHasTeachers,
                'lastCourseCreated'=>$lastCourse,
                'lastTeacherCreated'=>$lastCourse,
                'faculty'=>$faculty,
            ));
        }else{
            $this->createAccessDeniedException();
        }
        $this->redirectToRoute('dashboard',array(),307);
    }

    public function lookupCoursesAction(Request $request)
    {
        if($this->isGranted('ROLE_ADMIN')){
            $em = $this->getDoctrine()->getManager();
            $faculty = $this->getUser()->getPersonPerson()->getTeacher()->getTeacherHasfaculty()->first()->getFacultyFaculty();
            $facultyHasCourses = $faculty->getFacultyHasCourses();
            return $this->render('@App/Admin/courses_lookup.html.twig',array(
                'courses'=>$facultyHasCourses,
                'faculty'=>$faculty,
            ));
        }else{
            $this->createAccessDeniedException();
        }
        $this->redirectToRoute('dashboard',array(),307);
    }

    public function lookupTeachersAction(Request $request)
    {
        if($this->isGranted('ROLE_ADMIN')){

            $em = $this->getDoctrine()->getManager();
            $faculty = $this->getUser()->getPersonPerson()->getTeacher()->getTeacherHasfaculty()->first()->getFacultyFaculty();
            $facultyHasTeachers = $faculty->getFacultyHasTeacher();
            return $this->render('@App/Admin/teachers_lookup.html.twig',array(
                'teachers'=>$facultyHasTeachers,
                'faculty'=>$faculty,
            ));
        }else{
            $this->createAccessDeniedException();
        }
        $this->redirectToRoute('dashboard',array(),307);
    }
}

<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Course;
use AppBundle\Entity\Faculty;
use AppBundle\Entity\FacultyHasTeachers;
use AppBundle\Entity\RoleType;
use AppBundle\Entity\TeacherHasRole;
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
                /** @var User $user */
                $user = $this->getUser();
                if(!$user->getPersonPerson()){
                    $em = $this->getDoctrine()->getManager();
                    $person = $em->getRepository("AppBundle:Person")->findOneBy(array('email'=>$user->getEmail()));
                    if($person){
                        $user->setPersonPerson($person);
                        if($person->getTeacher()){
                            $rolesArr = array('ROLE_TEACHER');
                            $teacherHasRole = new TeacherHasRole();
                            /** @var RoleType $roleType */
                            $roleType = $em->getRepository('AppBundle:RoleType')->findOneBy(array('roleCode'=>'ROLE_TEACHER'));
                            $teacherHasRole->setRoleTypeRoleType($roleType);
                            $roleType->addTeachersHasRole($teacherHasRole);
                            $teacherHasRole->setTeacherTeacher($person->getTeacher());
                            $person->getTeacher()->addTeacherHasRole($teacherHasRole);
                            $user->setRoles($rolesArr);
                            $em->persist($teacherHasRole);
                            $em->persist($roleType);
                        }elseif($person->getStudent()){
                            $rolesArr = array('ROLE_STUDENT');
                            $user->setRoles($rolesArr);
                        }
                        $em->persist($user);
                        $em->persist($person);
                        $em->flush();
                    }
                }
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




}

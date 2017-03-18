<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Course;
use AppBundle\Entity\Faculty;
use AppBundle\Entity\User;
use Doctrine\ORM\QueryBuilder;
use FOS\UserBundle\Model\UserManagerInterface;
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
                    $person = $em->getRepository("AppBundle:Person")->findOneBy(array('peopleSoftEmail'=>$user->getEmail()));
                    if($person){
                        $user->setPersonPerson($person);
                        /** @var $userManager UserManagerInterface */
                        $userManager = $this->get('fos_user.user_manager');
                        if($person->isTeacher()){
                            $rolesArr = array('ROLE_TEACHER');
                            $user->setRoles($rolesArr);
                        }elseif($person->isStudent()){
                            $rolesArr = array('ROLE_STUDENT');
                            $user->setRoles($rolesArr);
                        }
                        $userManager->updateUser($user);
                        $em->persist($user);
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

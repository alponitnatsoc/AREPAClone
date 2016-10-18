<?php

namespace AppBundle\Controller;

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
            return $this->render('@App/Admin/admin_dashboard.html.twig');
        }else{
            $this->createAccessDeniedException();
        }
        $this->redirectToRoute('dashboard',array(),307);
    }
}

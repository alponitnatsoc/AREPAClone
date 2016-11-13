<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CourseController extends Controller
{
    public function showCourseInfoAction($courseCode,Request $request)
    {
        if($this->isGranted('ROLE_ADMIN')){

        }
        if($this->isGranted('ROLE_TEACHER')){

        }else{
            $this->createAccessDeniedException();
        }
        $this->redirectToRoute('dashboard',array(),307);
    }
}

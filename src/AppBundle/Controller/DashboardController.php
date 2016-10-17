<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends Controller
{
    public function indexAction(Request $request)
    {
        if($this->isGranted('ROLE_ADMIN')){
            return $this->render('@App/Admin/admin_dashboard.html.twig');
        }else{
            return $this->createAccessDeniedException();
        }

    }
}

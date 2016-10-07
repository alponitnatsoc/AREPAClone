<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function dashboardAction (){
        return $this->render("@App/Admin/admin_dashboard.html.twig");
    }
}

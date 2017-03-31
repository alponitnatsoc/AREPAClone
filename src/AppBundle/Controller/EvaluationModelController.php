<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;

class EvaluationModelController extends FOSRestController
{
    public function getTestAction()
    {
        $data = 'funciono';
        $view = View::create();
        $view->setData($data);
        $view->setStatusCode(200);
    }
}

<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Person;
use AppBundle\Form\newPersonForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PersonController extends Controller
{
    public function indexAction(Request $request)
    {
        $person = new Person();
        $form = $this->createForm(newPersonForm::class,$person);

        $form->handleRequest($request);
        if($form->isValid()){
            dump("hola");die;
        }
        return $this->render('AppBundle:Person:personForm.html.twig', array(
            'form'=>$form->createView(),
        ));
    }
}

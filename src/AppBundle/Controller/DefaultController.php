<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Course;
use AppBundle\Entity\Person;
use AppBundle\Entity\Role;
use AppBundle\Entity\Student;
use AppBundle\Entity\Teacher;
use AppBundle\Entity\User;
use AppBundle\Form\newPersonForm;
use Doctrine\DBAL\Driver\Mysqli\MysqliException;
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction( Request $request)
    {

        try{
            $em = $this->getDoctrine()->getManager();
            $person = new Person("Andres","Felipe","Ramirez","Bonilla","CC","1020772509","a.ramirezb@javeriana.edu.co","a.ramirezb","3183941645","M");
            $student = new Student(null,'1020340023',0.0,120);
            $teacher = new Teacher(null,'9871239',new \DateTime());
            $person->addPersonRole($student);
            $person->addPersonRole($teacher);
            $em->persist($person);
            $em->flush();
            $person = $em->getRepository("AppBundle:Person")->find(1);
            $roles = $person->getPersonRole();
            foreach ($roles as $role) {
                if($role instanceof Student){
                    dump($role->getAverageGrade());
                }elseif( $role instanceof Teacher){
                    dump($role->getCreatedAt());
                }
            }
            dump("hello");die;
        }catch (Exception $e){
            dump("Error code: ".$e->getCode()." Error message: ".$e->getMessage());
            die;
        }

//        /** @var User $user */
//        $user=$this->getUser();
//        $person = new Person();
//        $form = $this->createForm(newPersonForm::class,$person);

//        if(!$user){
//            $user = new User();
//            $user->setUsername('Andres');
//        }
//        $dir = "uploads/Files/Faculty";
//        foreach (scandir($dir) as $file) {
//            if ('.' === $file || '..' === $file) continue;
//            $inputFileType = \PHPExcel_IOFactory::identify($dir . '/' . $file);
//            if ($inputFileType != 'CSV') {
//                $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
//                /** @var \PHPExcel $obj */
//                $obj = $objReader->load($dir . '/' . $file);
//                /** @var \PHPExcel_Worksheet $worksheet */
//                foreach ($obj->getWorksheetIterator() as $worksheet) {
//                    $rowCount = 1;
//                    /** @var \PHPExcel_Worksheet_Row $row */
//                    foreach ($worksheet->getRowIterator() as $row) {
//                        if ($rowCount > 1) {
////                            $worksheet->getCellByColumnAndRow(2, $rowCount);
//                            dump($worksheet->getCellByColumnAndRow(1, $rowCount)->getValue());
//                        }
//                        $rowCount++;
//                    }
//                }
//            }
//        }

        if(empty($user)){
            return $this->redirectToRoute('fos_user_security_login');
        }
        return $this->redirectToRoute('dashboard',array('request'=>$request));
    }

    public function changeLocaleAction($locale = 'en',Request $request)
    {
        $request->attributes->set('_locale',null);
        $this->get('session')->set('_locale', $locale);
        return $this->redirect($request->headers->get('referer'));
    }
}

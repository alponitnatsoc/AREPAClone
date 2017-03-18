<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AssessmentContent;
use AppBundle\Entity\ClassCourse;
use AppBundle\Entity\Course;
use AppBundle\Entity\EvaluationModel;
use AppBundle\Entity\Person;
use AppBundle\Entity\Role;
use AppBundle\Entity\Student;
use AppBundle\Entity\Teacher;
use AppBundle\Entity\User;
use AppBundle\Form\newPersonForm;
use Doctrine\Common\Collections\Criteria;
use Doctrine\DBAL\Driver\Mysqli\MysqliException;
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction( Request $request)
    {

//        try{
            $em = $this->getDoctrine()->getManager();
            $person = new Person("Andres","Felipe","Ramirez","Bonilla","CC","1020772509","a.ramirezb@javeriana.edu.co","a.ramirezb","3183941645","M");
            $student = new Student(null,'1020340023',0.0,120);
            $teacher = new Teacher(null,'9871239',new \DateTime());
            $person->addPersonRole($student);
            $person->addPersonRole($teacher);
            $em->persist($person);
            $person2 = new Person("Jaime","Andres","Pavlich","Mariscal","CC","102921031","jpavlich@javeriana.edu.co","jpavlich","3183941645","M");
            $teacher2 = new Teacher(null,'0912390',new \DateTime());
            $person2->addPersonRole($teacher2);
            $em->persist($person2);
            $em->flush();
            $course = new Course("PREG","0238219",3,"Pensamiento Algoritmico","Pensamiento","Teorico-Practico",null);
            $classCourse = new ClassCourse("10021","1710",$course);
            $em->persist($classCourse);
            $classCourse2 = new ClassCourse("10022","1710",$course);
            $classCourse->addRole($teacher);
            $classCourse2->addRole($teacher);
            $classCourse->addRole($teacher2);
            $classCourse->addRole($student);
            $em->persist($classCourse);
            $em->flush();
//            $classCourse = $em->getRepository("AppBundle:ClassCourse")->findOneBy(array('classCode'=>'10021'));
            dump($classCourse->getTeachers());
            dump($classCourse2->getTeachers());
            dump($classCourse->getStudents());
            die;


//
//            dump($person->isTeacher());
//            die;
//        }catch (Exception $e){
//            dump("Error code: ".$e->getCode()." Error message: ".$e->getMessage());
//            die;
//        }

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

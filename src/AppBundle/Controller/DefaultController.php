<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Course;
use AppBundle\Entity\Person;
use AppBundle\Entity\User;
use AppBundle\Form\newPersonForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction( Request $request)
    {
        /** @var User $user */
        $user=$this->getUser();
//
//        foreach ($obj->getWorksheetIterator() as $worksheet) {
//            echo 'Worksheet - '. $worksheet->getTitle() ."<br>";
//
//            foreach ($worksheet->getRowIterator() as $row) {
//                echo '    Row number - ' . $row->getRowIndex() ."<br>";
//
//                $cellIterator = $row->getCellIterator();
//                $cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
//                foreach ($cellIterator as $cell) {
//                    if (!is_null($cell)) {
//                        echo '        Cell - ' . $cell->getCoordinate() .' - ' . $cell->getCalculatedValue() ."<br>";
//                    }
//                }
//            }
//        }


        if(empty($user)){
            return $this->redirectToRoute('fos_user_security_login');
        }else{
            return $this->redirectToRoute('dashboard',array('request'=>$request));
        }
//        $obj->setActiveSheetIndex(0)->setTitle("Notas-2016");
//        $sheet = $obj->getActiveSheet();
//        $sheet->setCellValue('A1','Nombre');
//        $sheet->setCellValue('A2',"Nota");
//        $sheet->setCellValue('B1','Andres');
//        $sheet->setCellValue('B2',"4.0");
//        $sheet->setCellValue('C1','Erika');
//        $sheet->setCellValue('C2',"4.0");
//        $writer = $this->get("phpexcel")->createWriter($obj);
//        $writer->save("notas.xlsx");
//        dump("Lo Logre");
    }

    public function changeLocaleAction($locale = 'en',Request $request)
    {
        $request->attributes->set('_locale',null);
        $this->get('session')->set('_locale', $locale);
        return $this->redirect($request->headers->get('referer'));
    }
}

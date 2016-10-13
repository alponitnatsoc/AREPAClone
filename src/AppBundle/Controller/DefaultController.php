<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Person;
use AppBundle\Form\newPersonForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction( Request $request)
    {

        $person = new Person();
        $form = $this->createForm(newPersonForm::class,$person);
        $form->handleRequest($request);
        if($form->isValid()){
            $name = $form->get('firstName')->getData();
            return $this->render('base.html.twig', array(
                'form'=>$form->createView(),
                'value'=>$name,
            ));
        }
        $a = 10;

//        $obj = \PHPExcel_IOFactory::load("notas.xlsx");
////        $obj = $this->get("phpexcel")->createPHPExcelObject();
//        echo date('H:i:s') ." Iterate worksheets" ."<br>";
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
        return $this->render('base.html.twig', array(
            'form'=>$form->createView(),
            'value'=>$a,
        ));
//        return $this->render('default/index.html.twig', [
//            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
//        ]);root_dir
    }
}

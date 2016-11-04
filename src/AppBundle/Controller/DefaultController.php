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

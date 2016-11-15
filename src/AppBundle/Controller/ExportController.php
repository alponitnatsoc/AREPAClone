<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Faculty;
use AppBundle\Entity\Person;
use AppBundle\Entity\Teacher;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\QueryBuilder;
use PHPExcel_Style_Border;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class ExportController extends Controller
{

    public function generateXLSAction($type,$all=false){
        $em = $this->getDoctrine()->getManager();
        $plataform = $em->getRepository("AppBundle:Plataform")->find(1);
        /** @var Faculty $faculty */
        $faculty = $this->getUser()->getPersonPerson()->getTeacher()->getTeacherHasfaculty()->first()->getFacultyFaculty();
        switch ($type){
            case 'teacher':
                if($all){
                    /** @var QueryBuilder $query */
                    $query = $em->createQueryBuilder();
                    $query->select('t');
                    $query
                        ->from('AppBundle:Teacher','t')
                        ->join('t.teacherHasfaculty','tf')
                        ->where('tf.facultyFaculty = ?1')
                        ->setParameter('1',$faculty);
                    $teachers = $query->getQuery()->getResult();
                }else{
                    /** @var QueryBuilder $query */
                    $query = $em->createQueryBuilder();
                    $query->select('t');
                    $query
                        ->from('AppBundle:Teacher','t')
                        ->join('t.teacherDictatesCourses','c')->join('c.courseCourse','cc')->join('cc.courseHasfaculty','cf')->join('t.teacherHasfaculty','f')->join('c.classes','cll')->join('cll.classClass','cl')
                        ->where('cl.activePeriod = ?1')->andWhere('f.facultyFaculty = ?2')->andWhere('cf.facultyFaculty = ?2')
//                    ->join('t.teacherDictatesCourses','c')->join('t.teacherHasfaculty','f')->join('c.classes','cll')->join('cll.classClass','cl')
//                    ->where('cl.activePeriod = ?1')->andWhere('f.facultyFaculty = ?2')
                        ->groupBy('t.idTeacher')
                        ->setParameter('1',$plataform->getActivePeriod())
                        ->setParameter('2',$faculty);
                    $teachers = $query->getQuery()->getResult();
                }
                $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();
                //setting some properties
                $phpExcelObject->getProperties()->setCreator("Symplifica-Doc-Generator")
                    ->setLastModifiedBy("Symplifica-Bot")
                    ->setTitle("General employerHasEmployee Info")
                    ->setSubject("Details")
                    ->setDescription("generated document with the employerHasEmployee information")
                    ->setKeywords("employee employeer contract")
                    ->setCategory("Information");
                //setting the active sheet and changing name
                $phpExcelObject->setActiveSheetIndex(0)->setTitle('Profesores');
                $outlineBorderTitleStyle= array(
                    'borders' => array(
                        'outline' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array('argb' => 'FF000000'),
                        ),
                    ),
                    'font'=>array(
                        'name'=>'Calibri',
                        'color' => array('argb'=>'FFFFFFFF'),
                        'bold' => true,
                        'size' => 12,
                    ),
                    'fill'=>array(
                        'type'=>'solid',
                        'color'=>array('argb'=>'FF818181'),
                    ),
                    'alignment'=>array(
                        'horizontal'=>'center',
                        'vertical'=>'center',
                    ),
                );
                $allBordersContentStyle = array(
                    'borders'=>array(
                        'allborders'=> array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array('argb' => 'FF000000'),
                        ),
                    ),
                    'font'=>array(
                        'name'=>'Calibri',
                        'color' => array('argb'=>'FF000000'),
                        'bold' => true,
                        'size' => 11,
                    ),
                    'fill'=>array(
                        'type'=>'solid',
                        'color'=>array('argb'=>'FFDBDBDB'),
                    ),
                    'alignment'=>array(
                        'horizontal'=>'left',
                        'vertical'=>'center',
                    ),
                );
                $allBordersNoContentStyle = array(
                    'borders'=>array(
                        'allborders'=> array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array('argb' => 'FF000000'),
                        ),
                    ),
                    'font'=>array(
                        'name'=>'Calibri',
                        'color' => array('argb'=>'FF000000'),
                        'size' => 10,
                    ),
                    'fill'=>array(
                        'type'=>'solid',
                        'color'=>array('argb'=>'FFFFFFFF'),
                    ),
                    'alignment'=>array(
                        'horizontal'=>'left',
                        'vertical'=>'center',
                    ),

                );
                $sheet = $phpExcelObject->getActiveSheet();
                $sheet->getColumnDimension('A')->setWidth(5);
                $sheet->getColumnDimension('B')->setWidth(13);
                $sheet->getColumnDimension('C')->setWidth(35);
                $sheet->getColumnDimension('D')->setWidth(10);
                $sheet->getColumnDimension('E')->setWidth(15);
                $sheet->getColumnDimension('F')->setWidth(30);
                $sheet->getRowDimension(1)->setRowHeight(17);
                $sheet->getRowDimension(2)->setRowHeight(16);
                $row=1;
                /** @var \PHPExcel_Cell $cell */
                $cell = $sheet->getCellByColumnAndRow(0,$row);
                $cell->setValue('INFORMATION TEACHERS');
                $row++;
                $cell = $sheet->getCellByColumnAndRow(0,$row);
                $iniCol = $cell->getColumn();
                $cell->setValue('ID');
                $cell = $sheet->getCellByColumnAndRow(1,$row);
                $cell->setValue('CODE');
                $cell = $sheet->getCellByColumnAndRow(2,$row);
                $cell->setValue('NAME');
                $cell = $sheet->getCellByColumnAndRow(3,$row);
                $cell->setValue('DOC_TYPE');
                $cell = $sheet->getCellByColumnAndRow(4,$row);
                $cell->setValue('DOC_NUMBER');
                $cell = $sheet->getCellByColumnAndRow(5,$row);
                $cell->setValue('EMAIL');
                $sheet->mergeCells($iniCol.($row-1).':'.$cell->getColumn().($row-1));
                $sheet->getStyle($iniCol.($row-1).':'.$cell->getColumn().($row-1))->applyFromArray($outlineBorderTitleStyle);
                $sheet->getStyle($iniCol.$row.':'.$cell->getColumn().$row)->applyFromArray($allBordersContentStyle);
                $row++;
                $iniRow = $row;
                /** @var Teacher $teacher */
                foreach ($teachers as $teacher) {
                    if($teacher->getIdTeacher()==0)continue;
                    $col=0;
                    $cell=$sheet->getCellByColumnAndRow($col,$row);
                    $cell->setValue($teacher->getIdTeacher());
                    $col++;
                    $cell=$sheet->getCellByColumnAndRow($col,$row);
                    $cell->setValue($teacher->getTeacherCode());
                    $col++;
                    $cell=$sheet->getCellByColumnAndRow($col,$row);
                    $name = '';
                    $docType = '';
                    $docNumber = '';
                    $email = '';
                    if($teacher->getPersonPerson()){
                        /** @var Person $person */
                        $person = $teacher->getPersonPerson();
                        $name = $person->getLastName1();
                        if($person->getLastName2())$name.= ' '.$person->getLastName2();
                        $name.=', '.$person->getFirstName();
                        if($person->getSecondName())$name.=' '.$person->getSecondName();
                        if($person->getDocumentType())$docType= $person->getDocumentType();
                        if($person->getDocument())$docNumber = $person->getDocument();
                        if($person->getEmail())$email = $person->getEmail();
                    }
                    $cell->setValue($name);
                    $col++;
                    $cell=$sheet->getCellByColumnAndRow($col,$row);
                    $cell->setValue($docType);
                    $col++;
                    $cell=$sheet->getCellByColumnAndRow($col,$row);
                    $cell->setValue($docNumber);
                    $col++;
                    $cell=$sheet->getCellByColumnAndRow($col,$row);
                    $cell->setValue($email);
                    $row++;
                }
                $sheet->getStyle($iniCol.$iniRow.':'.$cell->getColumn().($row-1))->applyFromArray($allBordersNoContentStyle);
                // create the writer
                $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel2007');
                // create the response
                $response = $this->get('phpexcel')->createStreamedResponse($writer);
                // adding headers
                if($all){
                    $dispositionHeader = $response->headers->makeDisposition(
                        ResponseHeaderBag::DISPOSITION_ATTACHMENT,
                        'All_Info_Teachers_'.date('d-m-y').'.xlsx'
                    );
                }else{
                    $dispositionHeader = $response->headers->makeDisposition(
                        ResponseHeaderBag::DISPOSITION_ATTACHMENT,
                        'Info_Teachers_'.date('d-m-y').'.xlsx'
                    );
                }
                $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
                $response->headers->set('Pragma', 'public');
                $response->headers->set('Cache-Control', 'maxage=1');
                $response->headers->set('Content-Disposition', $dispositionHeader);
                return $response;
                break;
        }
    }
}

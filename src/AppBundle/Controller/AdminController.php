<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ClassCourse;
use AppBundle\Entity\Course;
use AppBundle\Entity\CourseContributesOutcome;
use AppBundle\Entity\Faculty;
use AppBundle\Entity\Period;
use AppBundle\Entity\Person;
use AppBundle\Entity\User;
use AppBundle\Form\addDocument;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    public function adminDashboardAction(Request $request)
    {
        if($this->isGranted('ROLE_ADMIN')){
            $em = $this->getDoctrine()->getManager();
            $plataform = $em->getRepository("AppBundle:Plataform")->find(1);
            /** @var User $user */
            $user = $this->getUser();
            /** @var Faculty $faculty */
            $faculty = $user->getPersonPerson()->getTeacher()->getTeacherHasfaculty()->first()->getFacultyFaculty();
            $facultyHasCourses = $faculty->getFacultyHasCourses();
            $facultyHasTeachers = $faculty->getFacultyHasTeacher();
            /** @var QueryBuilder $query */
            $query = $em->createQueryBuilder();
            $query
                ->select('c,MAX(c.createdAt) AS max_score')
                ->from("AppBundle:Course",'c')
                ->groupBy('c.idCourse')
                ->setMaxResults(1)
                ->orderBy('max_score','DESC');
            $query2 = $em->createQueryBuilder();
            $query2
                ->select('t,MAX(t.createdAt) AS max_score')
                ->from("AppBundle:Teacher",'t')
                ->groupBy('t.idTeacher')
                ->setMaxResults(1)
                ->orderBy('max_score','DESC');
            /** @var Course $lastCourse */
            $lastCourse = $query->getQuery()->getResult()[0][0];
            $lastTeacher = $query2->getQuery()->getResult()[0][0];
            $formActivePeriod = $this->get('form.factory')->createNamedBuilder('formActivePeriod')
                ->add('period',EntityType::class,array(
                    'class'=>'AppBundle\Entity\Period',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('p')
                            ->orderBy('p.code', 'DESC');
                    },
                    'required'=>true,
                    'expanded'=>false,
                    'multiple'=>false,
                ))
                ->add('submit',SubmitType::class)
                ->getForm();

            $formPeriod = $this->get('form.factory')->createNamedBuilder('formAddPeriod')
                ->add('period',TextType::class,array('label'=>false,'required'=>true))
                ->add('submit',SubmitType::class)
                ->getForm();

            $formCoursesDocument = $this->createForm(addDocument::class);
            $formCoursesDocument
                ->add('upload', SubmitType::class);
            $formCoursesDocument['type']->setData('Course');

            $formActivePeriod->handleRequest($request);

            if($formActivePeriod->isSubmitted() and $formActivePeriod->isValid()){
                /** @var Period $tempPeriod */
                $tempPeriod=$formActivePeriod->get('period')->getData();
                try{
                    if($tempPeriod->getCode()!= $plataform->getActivePeriod()){
                        /** @var Period $period */
                        $period = $em->getRepository("AppBundle:Period")->findOneBy(array('code'=>$plataform->getActivePeriod()));
                        $ccos = $em->getRepository('AppBundle:CourseContributesOutcome')->findBy(array('period'=>$period));
                        $plataform->setActivePeriod($tempPeriod->getCode());
                        /** @var Period $newPeriod */
                        $newPeriod = $em->getRepository("AppBundle:Period")->findOneBy(array('code'=>$plataform->getActivePeriod()));
                        $newCcos = $em->getRepository('AppBundle:CourseContributesOutcome')->findBy(array('period'=>$newPeriod));
                        if(count($newCcos)==0){
                            /** @var CourseContributesOutcome $cco */
                            foreach ($ccos as $cco) {
                                $newcco = new CourseContributesOutcome();
                                $newcco->setCourseCourse($cco->getCourseCourse());
                                $newcco->setBloomLevel($cco->getBloomLevel());
                                $newcco->setOutcomeOutcome($cco->getOutcomeOutcome());
                                $newcco->setPeriod($newPeriod);
                                $cco->getOutcomeOutcome()->addCourseContributesOutcome($newcco);
                                $em->persist($cco->getOutcomeOutcome());
                                $em->persist($newcco);
                            }
                        }
                        $em->persist($plataform);
                        $em->flush();
                        $this->addFlash('message_title','app.success_period_change');
                        $this->addFlash('message_body','app.success_period_change_content');
                    }else{
                        $this->addFlash('message_title','app.same_period');
                        $this->addFlash('message_body','app.same_period_content');
                    }
                }catch(Exception $e){
                    $this->addFlash('message_title','app.period_change_fail');
                    $this->addFlash('message_body','app.period_change_fail_content');
                }

            }

            $formPeriod->handleRequest($request);
            if($formPeriod->isSubmitted() and $formPeriod->isValid()){
                $tempCode = $formPeriod->get('period')->getData();
                try {
                    if ($em->getRepository("AppBundle:Period")->findOneBy(
                            array('code' => $tempCode)
                        ) != null
                    ) {
                        $this->addFlash(
                            'message_title',
                            'app.period_already_exist'
                        );
                        $this->addFlash(
                            'message_body',
                            'app.period_already_exist_content'
                        );
                    } else {
                        $period = new Period();
                        $period->setCode($tempCode);
                        $plataform->addPeriod($period);
                        $em->persist($plataform);
                        $em->flush();
                        $this->addFlash(
                            'message_title',
                            'app.success_period_add'
                        );
                        $this->addFlash(
                            'message_body',
                            'app.success_period_add_content'
                        );
                    }
                }catch(Exception $e){
                    $this->addFlash('message_title','app.period_add_fail');
                    $this->addFlash('message_body','app.period_add_fail_content');
                }
            }

            $formCoursesDocument->handleRequest($request);

            if ($formCoursesDocument->isValid() and $formCoursesDocument->isSubmitted()) {

            }

            $query3 = $em->createQueryBuilder();
            $query3->select('cl');
            $query3
                ->from("AppBundle:ClassCourse",'cl')
                ->join('cl.courseCourse','c')
                ->join('c.courseHasfaculty','f')
                ->where('cl.activePeriod = ?1')
                ->andWhere('f.facultyFaculty = ?2')
                ->setParameter('1',$plataform->getActivePeriod())
                ->setParameter('2',$faculty);
            $query4=$em->createQueryBuilder();
            $query4->select('c,COUNT(c.idCourse) AS count_classes');
            $query4->from('AppBundle:Course','c')->join('c.classes','cl')->join('c.courseHasfaculty','f')
                ->where('cl.activePeriod = ?1')->andWhere('f.facultyFaculty = ?2')
                ->groupBy('c.idCourse')
                ->setParameter('1',$plataform->getActivePeriod())
                ->setParameter('2',$faculty);
            /** @var QueryBuilder $query5 */
            $query5 = $em->createQueryBuilder();
            $query5->select('t');
            $query5
                ->from('AppBundle:Teacher','t')
                ->join('t.teacherDictatesCourses','c')->join('c.courseCourse','cc')->join('cc.courseHasfaculty','cf')->join('t.teacherHasfaculty','f')->join('c.classes','cll')->join('cll.classClass','cl')
                ->where('cl.activePeriod = ?1')->andWhere('f.facultyFaculty = ?2')->andWhere('cf.facultyFaculty = ?2')
//                    ->join('t.teacherDictatesCourses','c')->join('t.teacherHasfaculty','f')->join('c.classes','cll')->join('cll.classClass','cl')
//                    ->where('cl.activePeriod = ?1')->andWhere('f.facultyFaculty = ?2')
                ->groupBy('t.idTeacher')
                ->setParameter('1',$plataform->getActivePeriod())
                ->setParameter('2',$faculty);

            return $this->render('@App/Admin/admin_dashboard.html.twig',array(
                'formAddCourses'=>$formCoursesDocument->createView(),
                'activeCourses'=>$query4->getQuery()->getResult(),
                'activeClasses'=>$query3->getQuery()->getResult(),
                'activeTeachers'=>$query5->getQuery()->getResult(),
                'courses'=>$facultyHasCourses,
                'teachers'=>$facultyHasTeachers,
                'lastCourseCreated'=>$lastCourse,
                'lastTeacherCreated'=>$lastTeacher,
                'faculty'=>$faculty,
                'periodAdd'=>$formPeriod->createView(),
                'activePeriod'=>$formActivePeriod->createView(),
                'plataform'=>$plataform,
            ));
        }else{
            $this->createAccessDeniedException();
        }
        $this->redirectToRoute('dashboard',array(),307);
    }

    public function lookupCoursesAction($active,Request $request)
    {
        if($this->isGranted('ROLE_ADMIN')){
            $em = $this->getDoctrine()->getManager();
            $plataform = $em->getRepository("AppBundle:Plataform")->find(1);
            $faculty = $this->getUser()->getPersonPerson()->getTeacher()->getTeacherHasfaculty()->first()->getFacultyFaculty();


            $formCoursesInfo= $this->createForm(addDocument::class);
            $formCoursesInfo
                ->add('upload', SubmitType::class);
            $formCoursesInfo['type']->setData('CourseInfo');
            $formCoursesInfo->handleRequest($request);

            if ($formCoursesInfo->isValid() and $formCoursesInfo->isSubmitted()) {
                if($this->checkFileCourses($formCoursesInfo->get('document')->getData())){
                    $this->addFlash('message_title','app.import_courses_success');
                    $this->addFlash('message_body','app.import_courses_success_content');
                }else{
                    $this->addFlash('message_title','app.import_courses_fail');
                    $this->addFlash('message_body','app.import_courses_fail_content');
                }
            }

            if($active){
                /** @var QueryBuilder $query */
                $query = $em->createQueryBuilder();
                $query->select('c');
                $query
                    ->from('AppBundle:Course','c')
                    ->join('c.classes','cl')->join('c.courseHasfaculty','f')
                    ->where('cl.activePeriod = ?1')->andWhere('f.facultyFaculty = ?2')
                    ->groupBy('c.idCourse')
                    ->setParameter('1',$plataform->getActivePeriod())
                    ->setParameter('2',$faculty);
                $courses = $query->getQuery()->getResult();
                return $this->render('@App/Admin/courses_lookup.html.twig',array(
                    'formInfoCourses'=>$formCoursesInfo->createView(),
                    'courses'=>$courses,
                    'faculty'=>$faculty,
                    'active'=>true,
                ));
            }else{
                $facultyHasCourses = $faculty->getFacultyHasCourses();
                return $this->render('@App/Admin/courses_lookup.html.twig',array(
                    'formInfoCourses'=>$formCoursesInfo->createView(),
                    'courses'=>$facultyHasCourses,
                    'faculty'=>$faculty,
                ));
            }
        }else{
            $this->createAccessDeniedException();
        }
        $this->redirectToRoute('dashboard',array(),307);
    }

    public function lookupTeachersAction($active,Request $request)
    {
        if($this->isGranted('ROLE_ADMIN')){
            $em = $this->getDoctrine()->getManager();
            $plataform = $em->getRepository("AppBundle:Plataform")->find(1);
            $faculty = $this->getUser()->getPersonPerson()->getTeacher()->getTeacherHasfaculty()->first()->getFacultyFaculty();
            $formTeachersInfo= $this->createForm(addDocument::class);
            $formTeachersInfo
                ->add('upload', SubmitType::class);
            $formTeachersInfo['type']->setData('TeachersInfo');
            $formTeachersInfo->handleRequest($request);

            if ($formTeachersInfo->isValid() and $formTeachersInfo->isSubmitted()) {
                if($this->checkFile($formTeachersInfo->get('document')->getData())){
                    $this->addFlash('message_title','app.import_teachers_success');
                    $this->addFlash('message_body','app.import_teachers_success_content');
                }else{
                    $this->addFlash('message_title','app.import_teachers_fail');
                    $this->addFlash('message_body','app.import_teachers_fail_content');
                }
            }

            if($active){
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
                return $this->render('@App/Admin/teachers_lookup.html.twig',array(
                    'formInfoTeachers'=>$formTeachersInfo->createView(),
                    'teachers'=>$teachers,
                    'faculty'=>$faculty,
                    'active'=>true,
                ));
            }else {
                $facultyHasTeachers = $faculty->getFacultyHasTeacher();
                return $this->render(
                    '@App/Admin/teachers_lookup.html.twig',
                    array(
                        'formInfoTeachers'=>$formTeachersInfo->createView(),
                        'teachers' => $facultyHasTeachers,
                        'faculty'  => $faculty,
                    )
                );
            }
        }else{
            $this->createAccessDeniedException();
        }
        $this->redirectToRoute('dashboard',array(),307);
    }

    public function lookupClassesAction(Request $request)
    {
        if($this->isGranted('ROLE_ADMIN')){

            $em = $this->getDoctrine()->getManager();
            $plataform = $em->getRepository("AppBundle:Plataform")->find(1);
            $faculty = $this->getUser()->getPersonPerson()->getTeacher()->getTeacherHasfaculty()->first()->getFacultyFaculty();

            $formClassesInfo= $this->createForm(addDocument::class);
            $formClassesInfo
                ->add('upload', SubmitType::class);
            $formClassesInfo['type']->setData('ClassesInfo');
            $formClassesInfo->handleRequest($request);

            if ($formClassesInfo->isValid() and $formClassesInfo->isSubmitted()) {
                if($this->checkFileClasses($formClassesInfo->get('document')->getData())){
                    $this->addFlash('message_title','app.import_classes_success');
                    $this->addFlash('message_body','app.import_classes_success_content');
                }else{
                    $this->addFlash('message_title','app.import_classes_fail');
                    $this->addFlash('message_body','app.import_classes_fail_content');
                }
            }

            /** @var QueryBuilder $query */
            $query = $em->createQueryBuilder();
            $query->select('cl');
            $query
                ->from("AppBundle:ClassCourse",'cl')
                ->join('cl.courseCourse','c')
                ->join('c.courseHasfaculty','f')
                ->where('cl.activePeriod = ?1')
                ->andWhere('f.facultyFaculty = ?2')
                ->setParameter('1',$plataform->getActivePeriod())
                ->setParameter('2',$faculty);

            return $this->render('@App/Admin/classes_lookup.html.twig',array(
                'formInfoClasses'=>$formClassesInfo->createView(),
                'classes'=>$query->getQuery()->getResult(),
                'faculty'=>$faculty,
            ));
        }else{
            $this->createAccessDeniedException();
        }
        $this->redirectToRoute('dashboard',array(),307);
    }

    private function checkFile($file){
        if (!file_exists('uploads/Files/TempFiles')) {
            mkdir('uploads/Files/TempFiles', 0777, true);
        }
        $em = $this->getDoctrine()->getManager();
        $absPath = getcwd();
        $tempFile = $file;
        $fileName = md5(uniqid()).'.'.$tempFile->guessExtension();
        $tempFile->move('uploads/Files/Tempfiles',$fileName);
        $inputFileType = \PHPExcel_IOFactory::identify('uploads/Files/Tempfiles'. '/' . $fileName);
        $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
        /** @var \PHPExcel $obj */
        $obj = $objReader->load('uploads/Files/Tempfiles' . '/' . $fileName);
        /** @var \PHPExcel_Worksheet $worksheet */
        foreach ($obj->getWorksheetIterator() as $worksheet) {
            $rowCount = 1;
            /** @var \PHPExcel_Worksheet_Row $row */
            foreach ($worksheet->getRowIterator() as $row) {
                if($rowCount==2){
                    if(!($worksheet->getCellByColumnAndRow(0, $rowCount)->getValue() == 'ID' and
                        $worksheet->getCellByColumnAndRow(1, $rowCount)->getValue() == 'CODE' and
                        $worksheet->getCellByColumnAndRow(2, $rowCount)->getValue() == 'NAME' and
                        $worksheet->getCellByColumnAndRow(3, $rowCount)->getValue() == 'DOC_TYPE' and
                        $worksheet->getCellByColumnAndRow(4, $rowCount)->getValue() == 'DOC_NUMBER' and
                        $worksheet->getCellByColumnAndRow(5, $rowCount)->getValue() == 'EMAIL')){
                        unlink('uploads/Files/Tempfiles'.'/'.$fileName);
                        return false;
                    }
                }
                if ($rowCount > 2) {
                    $teacherCode = $worksheet->getCellByColumnAndRow(1, $rowCount)->getValue();
                    $fullName = $worksheet->getCellByColumnAndRow(2, $rowCount)->getValue();
                    $docType = $worksheet->getCellByColumnAndRow(3, $rowCount)->getValue();
                    $docNum = $worksheet->getCellByColumnAndRow(4, $rowCount)->getValue();
                    $email = $worksheet->getCellByColumnAndRow(5, $rowCount)->getValue();
                    $teacher = $em->getRepository('AppBundle:Teacher')->findOneBy(array('teacherCode'=>$teacherCode));
                    if($teacher){
                        $person = $em->getRepository("AppBundle:Person")->findOneBy(array('documentType'=>$docType,'document'=>$docNum));
                        if($person){
                            $firstName=null;
                            $secondName=null;
                            $lastName2 =null;
                            $lastName1 = null;
                            if($person->getDocument()!= $docNum) $person->setDocument($docNum);
                            if($person->getDocumentType()!= $docType) $person->setDocumentType($docType);
                            if($person->getEmail()!= $email) $person->setEmail($email);
                            $name = explode(',',$fullName)[1];
                            $lastName= explode(',',$fullName)[0];
                            $firstName = explode(' ',$name)[0];
                            if(count(explode(' ',$name))>1)
                            $secondName = explode(' ',$name)[1];
                            $lastName1 = explode(' ',$lastName)[0];
                            if(count(explode(' ',$lastName))>1)
                            $lastName2 = explode(' ',$lastName)[1];
                            if($person->getFirstName()!= $firstName)$person->setFirstName($firstName);
                            if($person->getSecondName()!=$secondName)$person->setSecondName($secondName);
                            if($person->getLastName1()!=$lastName1)$person->setLastName1($lastName1);
                            if($person->getLastName2()!=$lastName2)$person->setLastName2($lastName2);
                            $em->persist($person);
                        }else{
                            $firstName=null;
                            $secondName=null;
                            $lastName2 =null;
                            $lastName1 = null;
                            $person = new Person();
                            $person->setDocumentType($docType);
                            $person->setDocument($docNum);
                            $name = explode(',',$fullName)[1];
                            $lastName= explode(',',$fullName)[0];
                            $firstName = explode(' ',$name)[0];
                            if(count(explode(' ',$name))>1)
                            $secondName = explode(' ',$name)[1];
                            $lastName1 = explode(' ',$lastName)[0];
                            if(count(explode(' ',$lastName))>1)
                            $lastName2 = explode(' ',$lastName)[1];
                            $person->setFirstName($firstName);
                            $person->setSecondName($secondName);
                            $person->setLastName1($lastName1);
                            $person->setLastName2($lastName2);
                            $person->setEmail($email);
                            $em->persist($person);
                            $em->flush();
                        }
                        if($teacher->getPersonPerson()!=$person or $teacher->getPersonPerson()==null){
                            $teacher->setPersonPerson($person);
                            $person->setTeacher($teacher);
                        }
                        $em->persist($person);
                        $em->persist($teacher);
                        $em->flush();
                    }
                }
                $rowCount++;
            }
            unlink('uploads/Files/Tempfiles'.'/'.$fileName);
            return true;
        }
    }


    private function checkFileCourses($file){
        if (!file_exists('uploads/Files/TempFiles')) {
            mkdir('uploads/Files/TempFiles', 0777, true);
        }
        $em = $this->getDoctrine()->getManager();
        $absPath = getcwd();
        $tempFile = $file;
        $fileName = md5(uniqid()).'.'.$tempFile->guessExtension();
        $tempFile->move('uploads/Files/Tempfiles',$fileName);
        $inputFileType = \PHPExcel_IOFactory::identify('uploads/Files/Tempfiles'. '/' . $fileName);
        $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
        /** @var \PHPExcel $obj */
        $obj = $objReader->load('uploads/Files/Tempfiles' . '/' . $fileName);
        /** @var \PHPExcel_Worksheet $worksheet */
        foreach ($obj->getWorksheetIterator() as $worksheet) {
            $rowCount = 1;
            /** @var \PHPExcel_Worksheet_Row $row */
            foreach ($worksheet->getRowIterator() as $row) {
                if($rowCount==2){
                    if(!($worksheet->getCellByColumnAndRow(0, $rowCount)->getValue() == 'ID' and
                        $worksheet->getCellByColumnAndRow(1, $rowCount)->getValue() == 'CODE' and
                        $worksheet->getCellByColumnAndRow(2, $rowCount)->getValue() == 'SHORT NAME' and
                        $worksheet->getCellByColumnAndRow(3, $rowCount)->getValue() == 'NAME' and
                        $worksheet->getCellByColumnAndRow(4, $rowCount)->getValue() == 'ACADEMIC_GRADE' and
                        $worksheet->getCellByColumnAndRow(5, $rowCount)->getValue() == 'COMPONENT' and
                        $worksheet->getCellByColumnAndRow(6, $rowCount)->getValue() == 'CREDITS')){
                        unlink('uploads/Files/Tempfiles'.'/'.$fileName);
                        return false;
                    }
                }
                if ($rowCount > 2) {
                    $courseCode = $worksheet->getCellByColumnAndRow(1, $rowCount)->getValue();
                    $courseShortName = $worksheet->getCellByColumnAndRow(2, $rowCount)->getValue();
                    $courseName = $worksheet->getCellByColumnAndRow(3, $rowCount)->getValue();
                    $courseAcademicGrade = $worksheet->getCellByColumnAndRow(4, $rowCount)->getValue();
                    $component = $worksheet->getCellByColumnAndRow(5, $rowCount)->getValue();
                    $credits = $worksheet->getCellByColumnAndRow(6, $rowCount)->getValue();
                    /** @var Course $course */
                    $course = $em->getRepository('AppBundle:Course')->findOneBy(array('courseCode'=>$courseCode));
                    if($course) {
                        if ($course->getShortNameCourse() != $courseShortName) $course->setShortNameCourse($courseShortName);
                        if ($course->getNameCourse() != $courseName) $course->setNameCourse($courseName);
                        if ($course->getAcademicGrade() != $courseAcademicGrade) $course->setAcademicGrade($courseAcademicGrade);
                        if ($course->getComponent() != $component) $course->setComponent($component);
                        if ($course->getCredits() != $courseShortName) $course->setCredits($credits);

                        $em->persist($course);
                        $em->flush();
                      }
                    }

                $rowCount++;
            }
            unlink('uploads/Files/Tempfiles'.'/'.$fileName);
            return true;
        }
    }



}

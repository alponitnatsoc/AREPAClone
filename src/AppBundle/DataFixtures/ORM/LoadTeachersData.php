<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 29/09/16
 * Time: 10:27 PM
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\ClassCourse;
use AppBundle\Entity\Faculty;
use AppBundle\Entity\FacultyHasCourses;
use AppBundle\Entity\FacultyHasTeachers;
use AppBundle\Entity\Person;
use AppBundle\Entity\Teacher;
use AppBundle\Entity\TeacherDictatesClassCourse;
use AppBundle\Entity\TeacherDictatesCourse;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Course;
use Symfony\Bundle\TwigBundle\Controller\PreviewErrorController;

class LoadTeachersData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        /**
         * ╔═══════════════════════════════════════════════════════════════╗
         * ║ Reporte generado en el catalogo de consultas SAE              ║
         * ║ Modulo QA Catálogo y Programación                             ║
         * ║ División 1 Catálogo y Sylabus                                 ║
         * ║ Opcion 3 Componentes de asignatura                            ║
         * ║ Parametros de la consulta                                     ║
         * ║ Institucion académica  PUJAV                                  ║
         * ║ Grado Académico --                                            ║
         * ║ Org Académica DPT-ISIST                                       ║
         * ╚═══════════════════════════════════════════════════════════════╝
         *
         * El archivo generado debe guardarse en la carpeta web/uploads/Courses/Files con nombre courses
         */
        $faculty = $manager->getRepository('AppBundle:Faculty')->findOneBy(array('facultyCode'=>'DPT-ISIST'));
        $teacher = $manager->getRepository('AppBundle:Teacher')->findOneBy(array('teacherCode'=>'ADMINISTRATOR'));
        if($teacher->getTeacherHasfaculty()->isEmpty()){
            $facultyHasTeacher=new FacultyHasTeachers();
            $facultyHasTeacher->setFacultyFaculty($faculty);
            $facultyHasTeacher->setTeacherTeacher($teacher);
            $teacher->addTeacherHasfaculty($facultyHasTeacher);
            $faculty->addFacultyHasTeacher($facultyHasTeacher);
            $manager->persist($facultyHasTeacher);
            $manager->flush();
        }
        $manager->getConnection()->getConfiguration()->setSQLLogger(null);
        echo "  > Memory usage before: " . (memory_get_usage()/1048576) . " MB" . PHP_EOL;
        $dir = "web/uploads/Files/Teachers";
        foreach (scandir($dir) as $file) {
            if ('.' === $file || '..' === $file || '.DS_Store' === $file) continue;
            $inputFileType = \PHPExcel_IOFactory::identify($dir . '/' . $file);
            echo '  > loading [2] '.$file.PHP_EOL;
            if ($inputFileType != 'CSV') {
                $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
                /** @var \PHPExcel $obj */
                $obj = $objReader->load($dir . '/' . $file);
                echo "  > loading [2] Teachers and ClassCourses". PHP_EOL;
                /** @var \PHPExcel_Worksheet $worksheet */
                foreach ($obj->getWorksheetIterator() as $worksheet) {
                    $rowCount = 1;
                    /** @var \PHPExcel_Worksheet_Row $row */
                    foreach ($worksheet->getRowIterator() as $row) {
                        if ($rowCount > 2) {
                            $facultyCode = $worksheet->getCellByColumnAndRow(11, $rowCount)->getValue();
                            if($facultyCode =='INGEN') $facultyCode='DPT-ISIST';
                            /** @var Faculty $faculty */
                            $faculty = $manager->getRepository("AppBundle:Faculty")->findOneBy(array('facultyCode' =>$facultyCode));
                            if(!$faculty){
                                $faculty = new Faculty();
                                $faculty->setFacultyCode($facultyCode);
                                $manager->persist($faculty);
                                $manager->flush();
                            }
                            $courseCode = $worksheet->getCellByColumnAndRow(4, $rowCount)->getValue();
                            /** @var Course $course */
                            $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode' => $courseCode));
                            if(!$course and $faculty){
                                $course = new Course();
                                $course->setCourseCode($courseCode);
                                $course->setAcademicGrade($worksheet->getCellByColumnAndRow(0, $rowCount)->getValue());
                                $course->setCreatedAt(new \DateTime());
                                $course->setNameCourse($worksheet->getCellByColumnAndRow(1, $rowCount)->getValue());
                                $course->setComponent($worksheet->getCellByColumnAndRow(14, $rowCount)->getValue());
                                $facultyHasCourse = new FacultyHasCourses();
                                $facultyHasCourse->setCourseCourse($course);
                                $facultyHasCourse->setFacultyFaculty($faculty);
                                $faculty->addFacultyHasCourse($facultyHasCourse);
                                $course->addCourseHasfaculty($facultyHasCourse);
                                $manager->persist($facultyHasCourse);
                                $manager->flush();
                            }elseif($course and $faculty and !$manager->getRepository("AppBundle:FacultyHasCourses")->findOneBy(array('facultyFaculty'=>$faculty, 'courseCourse'=>$course))){
                                if(!$course->getComponent())
                                    $course->setComponent($worksheet->getCellByColumnAndRow(14, $rowCount)->getValue());
                                if($course->getComponent()=='Teorico' and $worksheet->getCellByColumnAndRow(14, $rowCount)->getValue()=='Teorico Práctico')
                                    $course->setComponent($worksheet->getCellByColumnAndRow(14, $rowCount)->getValue());
                                $facultyHasCourse = new FacultyHasCourses();
                                $facultyHasCourse->setCourseCourse($course);
                                $facultyHasCourse->setFacultyFaculty($faculty);
                                $faculty->addFacultyHasCourse($facultyHasCourse);
                                $course->addCourseHasfaculty($facultyHasCourse);
                                $manager->persist($facultyHasCourse);
                                $manager->flush();
                            }else{
                                if(!$course->getComponent())
                                    $course->setComponent($worksheet->getCellByColumnAndRow(14, $rowCount)->getValue());
                                if($course->getComponent()=='Teorico' and $worksheet->getCellByColumnAndRow(14, $rowCount)->getValue()=='Teorico Práctico')
                                    $course->setComponent($worksheet->getCellByColumnAndRow(14, $rowCount)->getValue());
                                $manager->persist($course);
                                $manager->flush();
                            }
                            /** @var Person $person */
                            $person = $manager->getRepository("AppBundle:Person")->findOneBy(array('document' => $worksheet->getCellByColumnAndRow(18, $rowCount)->getValue()));
                            if(!$person){
                                $person = new Person();
                                $person->setDocumentType('CC');
                                $person->setDocument($worksheet->getCellByColumnAndRow(18, $rowCount)->getValue());
                                $strex = explode(',', $worksheet->getCellByColumnAndRow(19, $rowCount)->getValue());
                                $nameex = explode(' ', $strex[1]);
                                $lastex = explode(' ', $strex[0]);
                                if (count($nameex) > 1) {
                                    $person->setSecondName($nameex[1]);
                                }
                                $person->setFirstName($nameex[0]);
                                if (count($lastex) > 1) {
                                    $person->setLastName2($lastex[1]);
                                }
                                $person->setLastName1($lastex[0]);
                                $manager->persist($person);
                                $manager->flush();
                            }else{
                                if($person->getDocument()!= $worksheet->getCellByColumnAndRow(18, $rowCount)->getValue())$person->setDocument($worksheet->getCellByColumnAndRow(18, $rowCount)->getValue());
                                $manager->persist($person);
                                $manager->flush();
                            }
                            /** @var Teacher $teacher */
                            $teacher = $manager->getRepository("AppBundle:Teacher")->findOneBy(array('teacherCode' => $worksheet->getCellByColumnAndRow(17, $rowCount)->getValue()));
                            if(!$teacher){
                                $teacher = new Teacher();
                                $teacher->setTeacherCode($worksheet->getCellByColumnAndRow(17, $rowCount)->getValue());
                                if(!$person->getTeacher()){
                                    $teacher->setPersonPerson($person);
                                    $person->setTeacher($teacher);
                                    $manager->persist($person);
                                }
                                $manager->persist($teacher);
                                $manager->flush();
                            }elseif(!$teacher->getPersonPerson() and !$person->getTeacher()){
                                $teacher->setPersonPerson($person);
                                $person->setTeacher($teacher);
                                $manager->persist($person);
                                $manager->persist($teacher);
                                $manager->flush();
                            }
                            /** @var FacultyHasCourses $facultyHasCourse */
                            $facultyHasCourse = $manager->getRepository("AppBundle:FacultyHasCourses")->findOneBy(array('facultyFaculty'=>$faculty,'courseCourse'=>$course));
                            if(!$facultyHasCourse){
                                $facultyHasCourse = new FacultyHasCourses();
                                $facultyHasCourse->setCourseCourse($course);
                                $facultyHasCourse->setFacultyFaculty($faculty);
                                $faculty->addFacultyHasCourse($facultyHasCourse);
                                $course->addCourseHasfaculty($facultyHasCourse);
                                $manager->persist($facultyHasCourse);
                                $manager->flush();
                            }
                            /** @var TeacherDictatesCourse $teacherDictatesCourse */
                            $teacherDictatesCourse = $manager->getRepository("AppBundle:TeacherDictatesCourse")->findOneBy(array('courseCourse' => $course, 'teacherTeacher' => $teacher));
                            if(!$teacherDictatesCourse){
                                $teacherDictatesCourse = new TeacherDictatesCourse();
                                $teacherDictatesCourse->setCourseCourse($course);
                                $teacherDictatesCourse->setTeacherTeacher($teacher);
                                $teacher->addTeacherDictatesCourse($teacherDictatesCourse);
                                $course->addCourseIsDictatedByTeacher($teacherDictatesCourse);
                                $manager->persist($teacherDictatesCourse);
                                $manager->flush();
                            }
                            /** @var FacultyHasTeachers $facultyHasTeacher */
                            $facultyHasTeacher = $manager->getRepository("AppBundle:FacultyHasTeachers")->findOneBy(array('facultyFaculty' => $faculty, 'teacherTeacher' => $teacher));
                            if(!$facultyHasTeacher){
                                $facultyHasTeacher = new FacultyHasTeachers();
                                $facultyHasTeacher->setFacultyFaculty($faculty);
                                $facultyHasTeacher->setTeacherTeacher($teacher);
                                $teacher->addTeacherHasfaculty($facultyHasTeacher);
                                $faculty->addFacultyHasTeacher($facultyHasTeacher);
                                $manager->persist($facultyHasTeacher);
                                $manager->flush();
                            }
                            /** @var ClassCourse $classCourse */
                            $classCourse = $manager->getRepository("AppBundle:ClassCourse")->findOneBy(array('classCode' => $worksheet->getCellByColumnAndRow(6, $rowCount)->getValue(),'ciclolectivo'=>$worksheet->getCellByColumnAndRow(10, $rowCount)->getValue()));
                            if(!$classCourse){
                                $classCourse = new ClassCourse();
                                $classCourse->setClassCode($worksheet->getCellByColumnAndRow(6, $rowCount)->getValue());
                                $classCourse->setCourseCourse($course);
                                $classCourse->setCiclolectivo($worksheet->getCellByColumnAndRow(10, $rowCount)->getValue());
                                $course->addClass($classCourse);
                                $manager->persist($classCourse);
                                $manager->flush();
                            }
                            /** @var TeacherDictatesClassCourse $teacherDictatesClassCourse */
                            $teacherDictatesClassCourse = $manager->getRepository("AppBundle:TeacherDictatesClassCourse")->findOneBy(array('teacherDictatesCourse' => $teacherDictatesCourse, 'classClass' => $classCourse));
                            if(!$teacherDictatesClassCourse){
                                $teacherDictatesClassCourse = new TeacherDictatesClassCourse();
                                $teacherDictatesClassCourse->setClassClass($classCourse);
                                $teacherDictatesClassCourse->setTeacherDictatesCourse($teacherDictatesCourse);
                                $classCourse->addClassHasTeacher($teacherDictatesClassCourse);
                                $teacherDictatesCourse->addClass($teacherDictatesClassCourse);
                                $manager->persist($teacherDictatesClassCourse);
                                $manager->flush();
                            }
                            $manager->clear();
                        }
                        if($rowCount%2000==0){
                            echo "  > loading [2] Teachers and ClassCourses..".$rowCount. PHP_EOL;
                        }
                        $rowCount++;
                    }
                }
            }
        }
        echo "  > Memory usage after: " . (memory_get_usage()/1048576) . " MB" . PHP_EOL;
    }

    public function getOrder()
    {
        return 2;
    }
}
?> 
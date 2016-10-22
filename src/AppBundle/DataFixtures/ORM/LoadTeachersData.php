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
        /** @var \PHPExcel $obj */
        $obj = \PHPExcel_IOFactory::load("web/uploads/Teachers/Files/teachers");
        $worksheet = $obj->getActiveSheet();
        $rowCount = 1;
        foreach ($worksheet->getRowIterator() as $row) {
            if($rowCount>2){

                /** @var \PHPExcel_Worksheet_ColumnCellIterator $cellIterator */
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(true); //to loop al cells change to false
                $cellCount = 1;
                /** @var  \PHPExcel_Cell $cell */
                foreach ($cellIterator as $cell) {
                    if (!is_null($cell)) {
                        switch ($cellCount){
                            case 1:
                                $courseGrade =$cell->getValue();
                                break;
                            case 2:
                                $courseName =$cell->getValue();
                                break;
                            case 5:
                                $courseCode =$cell->getValue();
                                break;
                            case 7:
                                $classCode = $cell->getValue();
                                break;
                            case 11:
                                $cicle = $cell->getValue();
                                break;
                            case 12:
                               $facultyCode = $cell->getValue();
                                break;
                            case 15:
                                $courseComponent= $cell->getValue();
                                break;
                            case 18:
                                $teacherCode = $cell->getValue();
                                break;
                            case 19:
                                $teacherDocNum = $cell->getValue();
                                break;
                            case 20:
                                $teacherName = $cell->getValue();
                        }
                    }
                    $cellCount++;
                }
                if($manager->getRepository("AppBundle:Faculty")->findOneBy(array('facultyCode'=>$facultyCode))!= null){
                    $faculty = $manager->getRepository("AppBundle:Faculty")->findOneBy(array('facultyCode'=>$facultyCode));
                }else{
                    $faculty = new Faculty();
                    $faculty->setFacultyCode($facultyCode);
                    $manager->persist($faculty);
                    $manager->flush();
                }
                if($manager->getRepository("AppBundle:Person")->findOneBy(array('document'=>$teacherDocNum))!= null){
                    /** @var Person $person */
                    $person = $manager->getRepository("AppBundle:Person")->findOneBy(array('document'=>$teacherDocNum));
                }else{
                    $person = new Person();
                    $person->setDocumentType('CC');
                    $person->setDocument($teacherDocNum);
                    $strex = explode(',',$teacherName);
                    $nameex = explode(' ',$strex[0]);
                    $lastex = explode(' ',$strex[1]);
                    if(count($nameex)>1){
                       $person->setSecondName($nameex[1]);
                    }
                    $person->setFirstName($nameex[0]);
                    if(count($lastex)>1){
                        $person->setLastName2($lastex[1]);
                    }
                    $person->setLastName1($lastex[0]);
                    $manager->persist($person);
                    $manager->flush();
                }
                if($manager->getRepository("AppBundle:Teacher")->findOneBy(array('teacherCode'=>$teacherCode))!= null){
                    /** @var Teacher $tTeacher */
                    $teacher = $manager->getRepository("AppBundle:Teacher")->findOneBy(array('teacherCode'=>$teacherCode));
                }else{
                    $teacher = new Teacher();
                    $teacher->setPersonPerson($person);
                    $teacher->setTeacherCode($teacherCode);
                    $manager->persist($teacher);
                    $manager->flush();
                }
                if($manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>$courseCode))!= null){
                    $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>$courseCode));
                }else{
                    $course = new Course();
                    $courseHasFaculty = new FacultyHasCourses();
                    $courseHasFaculty->setCourseCourse($course);
                    $courseHasFaculty->setFacultyFaculty($faculty);
                    $manager->persist($courseHasFaculty);
                    $course->addCourseHasfaculty($courseHasFaculty);
                    $course->setCreatedAt(new \DateTime());
                    $course->setComponent($courseComponent);
                    $course->setCourseCode($courseCode);
                    $course->setAcademicGrade($courseGrade);
                    $course->setNameCourse($courseName);
                    $manager->persist($course);
                    $manager->flush();
                }
                if($manager->getRepository("AppBundle:ClassCourse")->findOneBy(array('classCode'=>$classCode))!= null){
                    /** @var ClassCourse $classCourse */
                    $classCourse = $manager->getRepository("AppBundle:ClassCourse")->findOneBy(array('classCode'=>$classCode));
                }else{
                    $classCourse = new ClassCourse();
                    $classCourse->setClassCode($classCode);
                    $classCourse->setCourseCourse($course);
                    $classCourse->setCiclolectivo($cicle);
                    $course->addClass($classCourse);
                    $manager->persist($classCourse);
                    $manager->flush();
                }
                if($manager->getRepository("AppBundle:FacultyHasTeachers")->findOneBy(array('facultyFaculty'=>$faculty,'teacherTeacher'=>$teacher)) != null){
                    $facultyHasTeacher = $manager->getRepository("AppBundle:FacultyHasTeachers")->findOneBy(array('facultyFaculty'=>$faculty,'teacherTeacher'=>$teacher));
                }else{
                    $facultyHasTeacher = new FacultyHasTeachers();
                    $facultyHasTeacher->setFacultyFaculty($faculty);
                    $facultyHasTeacher->setTeacherTeacher($teacher);
                    $teacher->addTeacherHasfaculty($facultyHasTeacher);
                    $manager->persist($facultyHasTeacher);
                    $manager->flush();
                }

                if($manager->getRepository("AppBundle:TeacherDictatesCourse")->findOneBy(array('courseCourse'=>$course,'teacherTeacher'=>$teacher)) != null){
                    $teacherDictatesCourse = $manager->getRepository("AppBundle:TeacherDictatesCourse")->findOneBy(array('courseCourse'=>$course,'teacherTeacher'=>$teacher));
                }else{
                    $teacherDictatesCourse = new TeacherDictatesCourse();
                    $teacherDictatesCourse->setCourseCourse($course);
                    $teacherDictatesCourse->setTeacherTeacher($teacher);
                    $teacher->addTeacherDictatesCourse($teacherDictatesCourse);
                    $manager->persist($teacherDictatesCourse);
                    $manager->flush();
                }
                if($manager->getRepository("AppBundle:TeacherDictatesClassCourse")->findOneBy(array('teacherDictatesCourse'=>$teacherDictatesCourse,'classClass'=>$classCourse)) != null){
                    $teacherDictatesClassCourse = $manager->getRepository("AppBundle:TeacherDictatesClassCourse")->findOneBy(array('teacherDictatesCourse'=>$teacherDictatesCourse,'classClass'=>$classCourse));
                }else{
                    $teacherDictatesClassCourse = new TeacherDictatesClassCourse();
                    $teacherDictatesClassCourse->setClassClass($classCourse);
                    $teacherDictatesClassCourse->setTeacherDictatesCourse($teacherDictatesCourse);
                    $manager->persist($teacherDictatesClassCourse);
                    $manager->flush();
                }
                $manager->flush();
            }
            $rowCount++;
        }



    }

    public function getOrder()
    {
        return 3;
    }
}
?> 
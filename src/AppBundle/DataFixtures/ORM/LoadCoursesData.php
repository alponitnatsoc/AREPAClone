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

class LoadCoursesData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $manager->getConnection()->getConfiguration()->setSQLLogger(null);
        echo "  > Memory usage before: " . (memory_get_usage()/1048576) . " MB" . PHP_EOL;
        $dir = "web/uploads/Files/Courses";
        foreach (scandir($dir) as $file) {
            if ('.' === $file || '..' === $file || '.DS_Store' === $file) continue;
            $inputFileType = \PHPExcel_IOFactory::identify($dir . '/' . $file);
            echo '  > loading [3] '.$file.PHP_EOL;
            if ($inputFileType != 'CSV') {
                $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
                /** @var \PHPExcel $obj */
                $obj = $objReader->load($dir . '/' . $file);
                echo "  > loading [3] Teacher and ClassCourse". PHP_EOL;
                /** @var \PHPExcel_Worksheet $worksheet */
                foreach ($obj->getWorksheetIterator() as $worksheet) {
                    $rowCount = 1;
                    /** @var \PHPExcel_Worksheet_Row $row */
                    foreach ($worksheet->getRowIterator() as $row) {
                        if ($rowCount > 2) {
                            $facultyCode = $worksheet->getCellByColumnAndRow(10, $rowCount)->getValue();
                            if($facultyCode =='INGEN') $facultyCode='DPT-ISIST';
                            /** @var Faculty $faculty */
                            $faculty = $manager->getRepository("AppBundle:Faculty")->findOneBy(array('facultyCode' =>$facultyCode));
                            if(!$faculty){
                                $faculty = new Faculty();
                                $faculty->setFacultyCode($facultyCode);
                                $manager->persist($faculty);
                                $manager->flush();
                            }
                            /** @var Person $person */
                            $person = $manager->getRepository("AppBundle:Person")->findOneBy(array('document' => $worksheet->getCellByColumnAndRow(15, $rowCount)->getValue()));
                            if(!$person){
                                $person = new Person();
                                $person->setDocumentType('CC');
                                $person->setDocument($worksheet->getCellByColumnAndRow(15, $rowCount)->getValue());
                                $strex = explode(',', $worksheet->getCellByColumnAndRow(16, $rowCount)->getValue());
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
                            }
                            /** @var Teacher $tTeacher */
                            $teacher = $manager->getRepository("AppBundle:Teacher")->findOneBy(array('teacherCode' => $worksheet->getCellByColumnAndRow(14, $rowCount)->getValue()));
                            if(!$teacher){
                                $teacher = new Teacher();
                                $teacher->setTeacherCode($worksheet->getCellByColumnAndRow(14, $rowCount)->getValue());
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
                            /** @var Course $course */
                            $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode' => $worksheet->getCellByColumnAndRow(2, $rowCount)->getValue()));
                            if($course){
                               if($course->getComponent()){
                                   if($course->getComponent()=='Teorico' and $worksheet->getCellByColumnAndRow(19, $rowCount)->getValue()=='Teorico Práctico'){
                                       $course->setComponent($worksheet->getCellByColumnAndRow(19, $rowCount)->getValue());
                                       $manager->persist($course);
                                       $manager->flush();
                                   }
                               }else{
                                   $course->setComponent($worksheet->getCellByColumnAndRow(19, $rowCount)->getValue());
                                   $manager->persist($course);
                                   $manager->flush();
                               }
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
                            /** @var ClassCourse $classCourse */
                            $classCourse = $manager->getRepository("AppBundle:ClassCourse")->findOneBy(array('classCode'    => $worksheet->getCellByColumnAndRow(4, $rowCount)->getValue(),
                                                                                                             'activePeriod' =>$worksheet->getCellByColumnAndRow(9, $rowCount)->getValue()));
                            if(!$classCourse){
                                $classCourse = new ClassCourse();
                                $classCourse->setClassCode($worksheet->getCellByColumnAndRow(4, $rowCount)->getValue());
                                $classCourse->setCourseCourse($course);
                                $classCourse->setActivePeriod($worksheet->getCellByColumnAndRow(9, $rowCount)->getValue());
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
                            echo "  > loading [3] Teacher and ClassCourse..".$rowCount. PHP_EOL;
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
        return 3;
    }
}
?> 
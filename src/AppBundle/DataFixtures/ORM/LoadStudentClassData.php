<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 29/09/16
 * Time: 10:27 PM
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\ClassCourse;
use AppBundle\Entity\Course;
use AppBundle\Entity\Faculty;
use AppBundle\Entity\FacultyHasCourses;
use AppBundle\Entity\FacultyHasStudents;
use AppBundle\Entity\FacultyHasTeachers;
use AppBundle\Entity\Person;
use AppBundle\Entity\Student;
use AppBundle\Entity\StudentAssistClass;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadStudentClassData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * ╔═══════════════════════════════════════════════════════════════╗
     * ║ Function load                                                 ║
     * ║ Creates data in the database entities from excel object.      ║
     * ║ ------------------------------------------------------------- ║
     * ║ Función load                                                  ║
     * ║ Crea los datos en las entidades de la base de datos desde un  ║
     * ║ objeto de excel.                                              ║
     * ╠═══════════════════════════════════════════════════════════════╣
     * ║  @param ObjectManager $manager                                ║
     * ╚═══════════════════════════════════════════════════════════════╝
     */
    public function load(ObjectManager $manager)
    {
        $manager->getConnection()->getConfiguration()->setSQLLogger(null);
        echo "  > Memory usage before: " . (memory_get_usage()/1048576) . " MB" . PHP_EOL;
        $dir = "web/uploads/Files/ClassCourses";
        foreach (scandir($dir) as $file) {
            if ('.' === $file || '..' === $file|| '.DS_Store' === $file) continue;
            $inputFileType = \PHPExcel_IOFactory::identify($dir . '/' . $file);
            echo '  > loading [3] '.$file.PHP_EOL;
            if($inputFileType!='CSV'){
                $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
                /** @var \PHPExcel $obj */
                $obj = $objReader->load($dir . '/' . $file);
                echo "  > loading [3] Students Classes". PHP_EOL;
                /** @var \PHPExcel_Worksheet $worksheet */
                foreach ($obj->getWorksheetIterator() as $worksheet){
                    $rowCount = 1;
                    /** @var \PHPExcel_Worksheet_Row $row */
                    foreach ($worksheet->getRowIterator() as $row){
                        if($rowCount>2){
                            $student = $manager->getRepository("AppBundle:Student")->findOneBy(array('studentCode' => $worksheet->getCellByColumnAndRow(0, $rowCount)->getValue()));
                            if($student){
                                /** @var Faculty $faculty */
                                $faculty = $manager->getRepository('AppBundle:Faculty')->findOneBy(array('facultyCode'=>'DPT-ISIST'));
                                /** @var FacultyHasStudents $facultyHasStudents */
                                $facultyHasStudents = $manager->getRepository('AppBundle:FacultyHasStudents')->findOneBy(array('facultyFaculty'=>$faculty,'studentStudent'=>$student));
                                if(!$facultyHasStudents){
                                    $facultyHasStudents = new FacultyHasStudents();
                                    $facultyHasStudents->setFacultyFaculty($faculty);
                                    $facultyHasStudents->setStudentStudent($student);
                                    $faculty->addFacultyHasStudent($facultyHasStudents);
                                    $student->addStudentHasFaculty($facultyHasStudents);
                                    $manager->persist($facultyHasStudents);
                                    $manager->flush();
                                }
                                /** @var Course $course */
                                $course = $manager->getRepository('AppBundle:Course')->findOneBy(array('courseCode'=>$worksheet->getCellByColumnAndRow(5, $rowCount)->getValue()));
                                if($course){
                                    /** @var ClassCourse $classCourse */
                                    $classCourse = $manager->getRepository("AppBundle:ClassCourse")->findOneBy(array('classCode'    => $worksheet->getCellByColumnAndRow(7, $rowCount)->getValue(),
                                                                                                                     'activePeriod' =>$worksheet->getCellByColumnAndRow(4, $rowCount)->getValue()));
                                    if(!$classCourse){
                                        $classCourse = new ClassCourse();
                                        $classCourse->setClassCode($worksheet->getCellByColumnAndRow(7, $rowCount)->getValue());
                                        $classCourse->setCourseCourse($course);
                                        $classCourse->setActivePeriod($worksheet->getCellByColumnAndRow(4, $rowCount)->getValue());
                                        $course->addClass($classCourse);
                                        $manager->persist($classCourse);
                                        $manager->flush();
                                    }
                                    /** @var StudentAssistClass $studentAssistClass */
                                    $studentAssistClass = $manager->getRepository('AppBundle:StudentAssistClass')->findOneBy(array('studentStudent'=>$student,'classCourseClassCourse'=>$classCourse));
                                    if(!$studentAssistClass){
                                        $studentAssistClass = new StudentAssistClass();
                                        $studentAssistClass->setStudentStudent($student);
                                        $studentAssistClass->setClassCourseClassCourse($classCourse);
                                        $student->addStudentAssistClass($studentAssistClass);
                                        $classCourse->addClassHasStudent($studentAssistClass);
                                        $manager->persist($studentAssistClass);
                                        $manager->flush();
                                    }elseif(!$studentAssistClass->getDefGrade() and $worksheet->getCellByColumnAndRow(9, $rowCount)->getValue()){
                                        $studentAssistClass->setDefGrade(floatval($worksheet->getCellByColumnAndRow(9, $rowCount)->getValue()));
                                        $manager->persist($studentAssistClass);
                                        $manager->flush();
                                    }elseif ($studentAssistClass->getDefGrade()!= floatval($worksheet->getCellByColumnAndRow(9, $rowCount)->getValue())){
                                        $studentAssistClass->setDefGrade(floatval($worksheet->getCellByColumnAndRow(9, $rowCount)->getValue()));
                                        $manager->persist($studentAssistClass);
                                        $manager->flush();
                                    }
                                }else{
                                    echo '  > loading [3] Course with id: '.$worksheet->getCellByColumnAndRow(5, $rowCount)->getValue().' Not found'.PHP_EOL;
                                }
                            }else{
                                echo '  > loading [3] Student with id: '.$worksheet->getCellByColumnAndRow(0, $rowCount)->getValue().' Not found'.PHP_EOL;

                            }
                            $manager->clear();
                        }
                        if($rowCount%2000==0){
                            echo "  > loading [3] Students..".$rowCount. PHP_EOL;
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
        return 6;
    }
}
?> 
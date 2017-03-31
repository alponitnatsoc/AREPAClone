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
use AppBundle\Entity\DefGrade;
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
        /**
         * ╔═══════════════════════════════════════════════════════════════╗
         * ║ Reporte generado en el catalogo de consultas SAE              ║
         * ║ Modulo SR Registro Estudiantil                                ║
         * ║ División 4 Situaciones Academicas y Notas                     ║
         * ║ Opcion 10 Historico Notas x Programa                          ║
         * ║ Parametros de la consulta                                     ║
         * ║ Institucion académica          PUJAV                          ║
         * ║ Grado Academico Base           PREG                           ║
         * ║ Programa Académico Principal   ISIST                          ║
         * ║ Ciclo Lectivo                  0910 - 1710                    ║
         * ║ ------------------------------------------------------------- ║
         * ║ Se debe generar el archivo csv por cada ciclo lectivo         ║
         * ║ Una vez generado el archivo, guardarlo en el directorio:      ║
         * ║ /web/uploads/Files/ClassCourses                               ║
         * ║ con nombre PUJAV_STUDENT_CLASSES_PREG_{ciclo lectivo}.csv     ║
         * ╚═══════════════════════════════════════════════════════════════╝
         */
        $manager->getConnection()->getConfiguration()->setSQLLogger(null);
        echo "\033[0;33m  >\033[0;32m Memory usage before: " . (memory_get_usage()/1048576) . " MB\033[0;00m" . PHP_EOL;
        $dir = "web/uploads/Files/ClassCourses";
        foreach (scandir($dir) as $file) {//42 COL
            if ('.' === $file || '..' === $file || '.DS_Store' === $file) continue;
            $filePath = $dir.'/'.$file;//
            $handle = fopen($filePath,'r');//opening the file in read mode
            $data = array();//initialising array data
            if($handle) {//checking handle opens correctly
                echo "\033[0;33m  >\033[0;32m loading [5] " . $file ."\033[0;00m". PHP_EOL;
                $count = 0;//course count in 0
                while(($buffer = fgets($handle)) !== false) {//getting the first line
                    $buffer = str_replace("\r\n",'',$buffer);//replacing special chars \r\n
                    $buffer = explode("//b\"", iconv("Windows-1252//IGNORE", "UTF-8", $buffer))[0];//ignoring special chars /b" in file
                    while(count(str_getcsv($buffer))<16){//checking data attributes lenght is 15
                        $str = fgets($handle);//if not getting the next handle
                        $str = str_replace("\r\n",'',$str);//replacing special chars \r\n
                        $str = explode("//b\"", iconv("Windows-1252//IGNORE", "UTF-8", $str))[0];//ignoring special chars /b" in file
                        $buffer.= $str;//adding the next handle to the previous handle
                    }
                    $data[$count]=str_getcsv($buffer);//getting all the student information in data array
                    if($count>0){
                        $faculty = $manager->getRepository("AppBundle:Faculty")->findOneBy(array('facultyCode'=>'DPT-ISIST'));
                        $studentCode = $data[$count][0];
                        $student = $manager->getRepository("AppBundle:Student")->findOneBy(array('studentCode' => $studentCode));
                        if(!$student){
                            echo '  > loading [5] Student with code: '.$studentCode.' Not found'.PHP_EOL;
                            continue;
                        }
                        if($student and $faculty and !$faculty->hasStudent($student)){
                            $faculty->addRole($student);
                            $manager->persist($faculty);
                        }
                        $courseCode = $data[$count][5];
                        while(strlen($courseCode)<6){
                            $courseCode = '0'.$courseCode;
                        }
                        $course = $manager->getRepository('AppBundle:Course')->findOneBy(array('courseCode'=>$courseCode));
                        if(!$course) {
                            echo '  > loading [5] Course with code: '.$courseCode.' Not found'.PHP_EOL;
                            continue;
                        }
                        $classCode = $data[$count][7];
                        $activePeriod = $data[$count][4];
                        $classCourse = $manager->getRepository("AppBundle:ClassCourse")->findOneBy(array('classCode'=> $classCode,'activePeriod' =>$activePeriod, 'course'=>$course));
                        if(!$classCourse) {
                            $classCourse = new ClassCourse($classCode,$activePeriod,$course);
                        }
                        if(!$classCourse->hasStudent($student)){
                            $classCourse->addRole($student);
                            $manager->persist($classCourse);
                        }
                        if($data[$count][9] != null and $data[$count][9] != ''){
                            $defGradeValue = floatval($data[$count][9]);
                            $defGrade = new DefGrade($student,$classCourse,$defGradeValue);
                            $student->addGrade($defGrade);
                            $manager->persist($student);
                        }
                        $manager->flush();
                        $manager->clear();
                    }
                    if($count % 200 == 0){
                        echo "\033[0;33m  >\033[0;32m loading [5] Student Class Courses..".$file.' '.$count."\033[0;00m".PHP_EOL;
                    }
                    $count++;
                }
                fclose($handle);
            }
        }
        echo "\033[0;33m  >\033[0;32m Memory usage after: " . (memory_get_usage()/1048576) . " MB\033[0;00m" . PHP_EOL;
    }

    public function getOrder()
    {
        return 5;
    }
}
?> 
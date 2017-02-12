<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 29/09/16
 * Time: 10:27 PM
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Controller\UtilsController;
use AppBundle\Entity\Course;
use AppBundle\Entity\Faculty;
use AppBundle\Entity\FacultyHasCourses;
use AppBundle\Entity\FacultyHasTeachers;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\Container;

class LoadInitialData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * ╔═══════════════════════════════════════════════════════════════╗
     * ║ Function load                                                 ║
     * ║ Creates data in the database entities from excel object.      ║
     * ║ ------------------------------------------------------------- ║
     * ║ Función load                                                  ║
     * ║ Crea los datos en las entidades de la base de datos desde un  ║
     * ║ objeto de excel o csv.                                        ║
     * ║                                                               ║
     * ║ Esta fixture carga la informacion de las facultades y sus     ║
     * ║ cursos.                                                       ║
     * ╠═══════════════════════════════════════════════════════════════╣
     * ║  @param ObjectManager $manager                                ║
     * ╚═══════════════════════════════════════════════════════════════╝
     */
    public function load(ObjectManager $manager)
    {
        /**
         * ╔═══════════════════════════════════════════════════════════════╗
         * ║ Reporte generado en el catalogo de consultas SAE              ║
         * ║ Modulo QA Catálogo y Programación                             ║
         * ║ División 1 Catálogo y Sylabus                                 ║
         * ║ Opcion 5 Componentes de asignatura                            ║
         * ║ Parametros de la consulta                                     ║
         * ║ Institucion académica  PUJAV                                  ║
         * ║ ------------------------------------------------------------- ║
         * ║ Se debe generar el archivo csv                                ║
         * ║ Una vez generado el archivo, guardarlo en el directorio:      ║
         * ║ /web/uploads/Files/Faculty                                    ║
         * ║ con nombre Faculties.csv                                      ║
         * ╚═══════════════════════════════════════════════════════════════╝
         */
        $manager->getConnection()->getConfiguration()->setSQLLogger(null);
        echo "\033[0;33m  >\033[0;32m Memory usage before: " . (memory_get_usage()/1048576) . " MB \033[0;00m " . PHP_EOL;//printing actual memory usage
        $dir = "web/uploads/Files/Faculty";//getting the faculties directory
        foreach (scandir($dir) as $file) {//getting all the files in directory
            if ('.' === $file || '..' === $file) continue;//ignoring linux and os x temporal files
                $filePath = $dir.'/'.$file;//
                $handle = fopen($filePath,'r');//opening the file in read mode
                $data = array();//initialising array data
                if($handle){//checking handle opens correctly
                    $count = 0;//course count in 0
                    while(($buffer = fgets($handle)) !== false) {//getting the first line
                        $buffer = str_replace("\r\n",'',$buffer);//replacing special chars \r\n
                        $buffer = explode("//b\"", iconv("Windows-1252//IGNORE", "UTF-8", $buffer))[0];//ignoring special chars /b" in file
                        while(count(str_getcsv($buffer))<15){//checking data attributes lenght is 15
                            $str = fgets($handle);//if not getting the next handle
                            $str = str_replace("\r\n",'',$str);//replacing special chars \r\n
                            $str = explode("//b\"", iconv("Windows-1252//IGNORE", "UTF-8", $str))[0];//ignoring special chars /b" in file
                            $buffer.= $str;//adding the next handle to the previous handle
                        }
                        $data[$count]=str_getcsv($buffer);//getting all the course information in data array
                        if($count>0){//ignoring the first row column names
                            $facultyCode = $data[$count][1];//getting the faculty code from array data
                            $facultyName = $data[$count][2];//getting the faculty name from array data
                            /** @var Faculty $faculty */
                            $faculty = $manager->getRepository("AppBundle:Faculty")->findOneBy(array('facultyCode'=>$facultyCode));//finding if faculty already exist
                            if(!$faculty){//if not creates the new faculty with the previous params
                                $faculty = new Faculty();
                                $faculty->setName(strval($facultyName));
                                $faculty->setFacultyCode($facultyCode);
                                $manager->persist($faculty);
                                //echo "   [--Facultad: ".$faculty->getName()." Cod: ".$facultyCode." creada.--]".PHP_EOL;
                            }
                            $courseCode = $data[$count][4];//getting the course code
                            $credits = $data[$count][7];//getting the course credits
                            $courseName = $data[$count][5];//getting the course name
                            $shortName = $data[$count][6];//getting the course short name
                            $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode' => $courseCode));//finding if the course already exist
                            if($faculty and !$course){//if faculty exist and course doesn't exist creating the course and adding the relation with the faculty
                                $course = new Course();
                                $course->setCourseCode($courseCode);
                                $course->setAcademicGrade($data[$count][0]);
                                $course->setCreatedAt(new \DateTime());
                                $course->setCredits($credits);
                                $course->setNameCourse($courseName);
                                $course->setShortNameCourse($shortName);
                                $facultyHasCourse = new FacultyHasCourses();
                                $facultyHasCourse->setCourseCourse($course);
                                $facultyHasCourse->setFacultyFaculty($faculty);
                                $faculty->addFacultyHasCourse($facultyHasCourse);
                                $course->addCourseHasfaculty($facultyHasCourse);
                                $manager->persist($facultyHasCourse);
                                //echo "   [--Curso: ".$course->getNameCourse()." Cod: ".$course->getCourseCode()." creado.--]".PHP_EOL;
                            }elseif($faculty and $course
                                and !$manager->getRepository("AppBundle:FacultyHasCourses")->findOneBy(array('facultyFaculty'=>$faculty, 'courseCourse'=>$course))){
                                //if both course and faculty exist but relation between them doesn't exist creating only the relation
                                $facultyHasCourse = new FacultyHasCourses();
                                $facultyHasCourse->setCourseCourse($course);
                                $facultyHasCourse->setFacultyFaculty($faculty);
                                $faculty->addFacultyHasCourse($facultyHasCourse);
                                $course->addCourseHasfaculty($facultyHasCourse);
                                $manager->persist($facultyHasCourse);
                            }
                            $manager->flush();
                            /** @var FacultyHasCourses $facultyHasCourse */
                            $facultyHasCourse = $manager->getRepository("AppBundle:FacultyHasCourses")->findOneBy(array('facultyFaculty'=>$faculty,'courseCourse'=>$course));
                            //if the relation doesn't exist at this step crating only the relation
                            if(!$facultyHasCourse){
                                $facultyHasCourse = new FacultyHasCourses();
                                $facultyHasCourse->setCourseCourse($course);
                                $facultyHasCourse->setFacultyFaculty($faculty);
                                $faculty->addFacultyHasCourse($facultyHasCourse);
                                $course->addCourseHasfaculty($facultyHasCourse);
                                $manager->persist($facultyHasCourse);
                                $manager->flush();
                            }
                            $manager->clear();
                        }
                        if($count%2000 == 0){
                            echo "\033[0;33m  >\033[0;32m loading [1] Faculties and Courses..".$count."\033[0;00m".PHP_EOL;
                        }
                        $count++;
                    }
                    fclose($handle);
                }
        }
        echo "\033[0;33m  >\033[0;32m Memory usage after: " . (memory_get_usage()/1048576) . " MB \033[0;00m". PHP_EOL;
    }

    public function getOrder()
    {
        return 2;
    }
}
?> 
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
use AppBundle\Entity\Person;
use AppBundle\Entity\Teacher;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Course;
use Symfony\Bundle\TwigBundle\Controller\PreviewErrorController;

class LoadTeachersData extends AbstractFixture implements OrderedFixtureInterface
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
     * ║ Esta fixture carga la informacion de los profesores y sus     ║
     * ║ cursos asignandoles la persona y la facultad.                 ║
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
         * ║ División 2 Programación de Clases                             ║
         * ║ Opcion 5 Cursos Programados con asoc                          ║
         * ║ Parametros de la consulta                                     ║
         * ║ Institucion académica  PUJAV                                  ║
         * ║ Grado Academico        PREG|GRAD                              ║
         * ║ Org Académica          %                                      ║
         * ║ Ciclo Lectivo          1430 a 1710                            ║
         * ║ ------------------------------------------------------------- ║
         * ║ Se deben generar los archivos csv por cada ciclo lectivo      ║
         * ║ Una vez generados guardarlos en el directorio:                ║
         * ║ /web/uploads/Files/Teachers                                   ║
         * ║ con nombre PUJAV_TEACHERS_(PREG_POST)_{ciclo lectivo}.csv     ║
         * ╚═══════════════════════════════════════════════════════════════╝
         */
        $faculty = $manager->getRepository('AppBundle:Faculty')->findOneBy(array('facultyCode'=>'DPT-ISIST'));
        $teacher = $manager->getRepository('AppBundle:Teacher')->findOneBy(array('teacherCode'=>'ADMINISTRATOR'));
        if($teacher->getFaculties()->isEmpty()){
            $faculty->addRole($teacher);
            $manager->persist($faculty);
        }
        $manager->getConnection()->getConfiguration()->setSQLLogger(null);
        echo "\033[0;33m  >\033[0;32m Memory usage before: " . (memory_get_usage()/1048576) . " MB\033[0;00m" . PHP_EOL;
        $dir = "web/uploads/Files/Teachers";
        foreach (scandir($dir) as $file) {//42 COL
            if ('.' === $file || '..' === $file || '.DS_Store' === $file) continue;
            $filePath = $dir.'/'.$file;//
            $handle = fopen($filePath,'r');//opening the file in read mode
            $data = array();//initialising array data
            if($handle) {//checking handle opens correctly
                echo "\033[0;33m  >\033[0;32m loading [3] " . $file ."\033[0;00m". PHP_EOL;
                $count = 0;//course count in 0
                while (($buffer = fgets($handle)) !== false) {//getting the first line
                    $buffer = str_replace("\r\n", '', $buffer);//replacing special chars \r\n
                    $buffer = explode("//b\"", iconv("Windows-1252//IGNORE", "UTF-8", $buffer))[0];//ignoring special chars /b" in file
                    while (count(str_getcsv($buffer)) < 42) {//checking data attributes lenght is 15
                        $str = fgets($handle);//if not getting the next handle
                        $str = str_replace("\r\n", '', $str);//replacing special chars \r\n
                        $str = explode("//b\"", iconv("Windows-1252//IGNORE", "UTF-8", $str))[0];//ignoring special chars /b" in file
                        $buffer .= $str;//adding the next handle to the previous handle
                    }
                    $data[$count]=str_getcsv($buffer);//getting all the course information in data array
                    if($count>0){
                        $facultyCode = $data[$count][11];
                        if($facultyCode =='INGEN') $facultyCode='DPT-ISIST';
                        /** @var Faculty $faculty */
                        $faculty = $manager->getRepository("AppBundle:Faculty")->findOneBy(array('facultyCode' =>$facultyCode));
                        if($faculty == null){
                            $faculty = new Faculty(null,$facultyCode);
                            $manager->persist($faculty);
                        }
                        $documentNumber = $data[$count][18];
                        $fullName = $data[$count][19];//getting the person name
                        /** @var Person $person */
                        $person = $manager->getRepository("AppBundle:Person")->findOneBy(array('document' => $documentNumber));
                        if(!$person){
                            $strex = explode(',', $fullName);
                            $nameex = explode(' ', $strex[1]);
                            $lastex = explode(' ', $strex[0]);
                            $secondName = '';
                            if(count($nameex) == 1){
                                $secondName = '';
                            } elseif (count($nameex) == 2) {
                                $secondName.= $nameex[1];
                            } elseif (count($nameex) > 2){
                                for($i = 1 ; $i<count($nameex);$i++){
                                    $secondName.=($i==1)?$nameex[$i]:' '.$nameex[$i];
                                }
                            }
                            $firstName = $nameex[0];
                            $lastName2 = '';
                            if(count($lastex) == 1){
                                $lastName2 = '';
                            } elseif (count($lastex) == 2) {
                                $lastName2 .= $lastex[1];
                            }elseif(count($lastex) > 2){
                                for($i = 1 ; $i<count($lastex);$i++){
                                    $lastName2.=($i==1)?$lastex[$i]:' '.$lastex[$i];
                                }
                            }
                            $lastName1 = $lastex[0];
                            $person = new Person($firstName,$secondName,$lastName1,$lastName2,'CC',$documentNumber);
                        }
                        $teacherCode = $data[$count][17];
                        /** @var Teacher $teacher */
                        $teacher = $manager->getRepository("AppBundle:Teacher")->findOneBy(array('teacherCode' => $teacherCode));
                        if($teacher == null){
                            $teacher = new Teacher(null,$teacherCode,new \DateTime());
                            $person->addPersonRole($teacher);
                        }
                        $manager->persist($person);
                        $courseCode = $data[$count][4];
                        /** @var Course $course */
                        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode' => $courseCode));
                        if($course == null){
                            $academicGrade = $data[$count][0];
                            $courseName = $data[$count][1];
                            $courseComponent = $data[$count][14];
                            $course = new Course($academicGrade,$courseCode,null,$courseName,null,$courseComponent);
                            $course->addFaculty($faculty);
                            $manager->persist($course);
                        }else{
                            $courseComponent = $data[$count][14];
                            if($course->getComponent() and $course->getComponent()=='Teorico' and $courseComponent=='Teorico Práctico'){
                                $course->setComponent($courseComponent);
                            }else{
                                $course->setComponent($courseComponent);
                            }
                            $manager->persist($course);
                        }
                        //If course relation with faculty doesn't exist
                        if(!$course->belongsToFaculty($faculty)){
                            $course->addFaculty($faculty);
                            $manager->persist($course);
                        }
                        if(!$teacher->dictatesCourse($course)){
                            $teacher->addCourse($course);
                            $manager->persist($teacher);
                        }
                        if(!$faculty->hasTeacher($teacher)){
                            $faculty->addRole($teacher);
                            $manager->persist($faculty);
                        }
                        $classCode = $data[$count][6];
                        $activePeriod = $data[$count][10];
                        /** @var ClassCourse $classCourse */
                        $classCourse = $manager->getRepository("AppBundle:ClassCourse")->findOneBy(array('classCode'=> $classCode,'activePeriod' =>$activePeriod));
                        if(!$classCourse){
                            $classCourse = new ClassCourse($classCode,$activePeriod,$course);
                            $classCourse->addRole($teacher);
                            $manager->persist($classCourse);
                        }
                        $manager->flush();
                        $manager->clear();
                    }
                    if($count%2000 == 0){
                        echo "\033[0;33m  >\033[0;32m loading [3] Teachers and ClassCourses..".$file.' '.$count."\033[0;00m".PHP_EOL;
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
        return 3;
    }
}
?> 
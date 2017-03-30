<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 29/09/16
 * Time: 10:27 PM
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Course;
use AppBundle\Entity\Faculty;
use AppBundle\Entity\Person;
use AppBundle\Entity\Student;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadStudentData extends AbstractFixture implements OrderedFixtureInterface
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
     * ║ Esta fixture carga la informacion de los estudiantes activos  ║
     * ║ les asigna la persona y el estudiante                         ║
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
         * ║ División 3 Matricula                                          ║
         * ║ Opcion 8 Dat perso estudiantes activos                        ║
         * ║ Parametros de la consulta                                     ║
         * ║ Institucion académica          PUJAV                          ║
         * ║ Grado Academico Base           PREG                           ║
         * ║ Programa Académico Principal   ISIST                          ║
         * ║ Ciclo Lectivo                  %                              ║
         * ║ ------------------------------------------------------------- ║
         * ║ Se debe generar el archivo csv                                ║
         * ║ Una vez generado el archivo, guardarlo en el directorio:      ║
         * ║ /web/uploads/Files/Students                                   ║
         * ║ con nombre PUJAV_STUDENTS_PREG.csv                            ║
         * ╚═══════════════════════════════════════════════════════════════╝
         */

        $manager->getConnection()->getConfiguration()->setSQLLogger(null);
        echo "\033[0;33m  >\033[0;32m Memory usage before: " . (memory_get_usage()/1048576) . " MB\033[0;00m" . PHP_EOL;
        $dir = "web/uploads/Files/Students";
        foreach (scandir($dir) as $file) {//42 COL
            if ('.' === $file || '..' === $file || '.DS_Store' === $file) continue;
            $filePath = $dir.'/'.$file;//
            $handle = fopen($filePath,'r');//opening the file in read mode
            $data = array();//initialising array data
            if($handle) {//checking handle opens correctly
                echo "\033[0;33m  >\033[0;32m loading [4] " . $file ."\033[0;00m". PHP_EOL;
                $count = 0;//course count in 0
                while(($buffer = fgets($handle)) !== false) {//getting the first line
                    $buffer = str_replace("\r\n",'',$buffer);//replacing special chars \r\n
                    $buffer = explode("//b\"", iconv("Windows-1252//IGNORE", "UTF-8", $buffer))[0];//ignoring special chars /b" in file
                    while(count(str_getcsv($buffer))<22){//checking data attributes lenght is 15
                        $str = fgets($handle);//if not getting the next handle
                        $str = str_replace("\r\n",'',$str);//replacing special chars \r\n
                        $str = explode("//b\"", iconv("Windows-1252//IGNORE", "UTF-8", $str))[0];//ignoring special chars /b" in file
                        $buffer.= $str;//adding the next handle to the previous handle
                    }
                    $data[$count]=str_getcsv($buffer);//getting all the student information in data array
                    if($count>0){
                        $faculty = $manager->getRepository("AppBundle:Faculty")->findOneBy(array('facultyCode'=>'DPT-ISIST'));
                        if($faculty){
                            $noEmail = false;
                            $documentType = $data[$count][4];
                            $documentNumber = $data[$count][5];
                            $firstName = $data[$count][6];
                            $secondName = ($data[$count][7] != '') ? $data[$count][7] : null;
                            $lastName1 = $data[$count][8];
                            $lastName2 = ($data[$count][9] != '') ? $data[$count][9] : null;
                            $phone = $data[$count][13];
                            if($data[$count][14]=='' or $data[$count][14]==null){
                                $peopleSoftEmail = null;
                                $peopleSoftUserName = null;
                                $noEmail = true;
                            }else{
                                $peopleSoftEmail = $data[$count][14];
                                $peopleSoftUserName = explode('@', $peopleSoftEmail)[0];
                            }
                            $gender = $data[$count][16];
                            if($noEmail){
                                if($manager->getRepository("AppBundle:Person")->findOneBy(array('document' => $documentNumber))==null){
                                    $person = new Person($firstName, $secondName, $lastName1, $lastName2, $documentType, $documentNumber, null, null, $phone, $gender);
                                }else{
                                    $person = $manager->getRepository("AppBundle:Person")->findOneBy(array('document' => $documentNumber));
                                    if($person->getPhone()!=$phone and $phone!= null)$person->setPhone($phone);
                                    if($person->getGender()!=$gender and $gender != null)$person->setGender($gender);
                                }
                            }elseif($manager->getRepository("AppBundle:Person")->findOneBy(array('peopleSoftEmail' => $peopleSoftEmail))==null){
                                if($manager->getRepository("AppBundle:Person")->findOneBy(array('document' => $documentNumber)) != null){
                                    $person = $manager->getRepository("AppBundle:Person")->findOneBy(array('document' => $documentNumber));
                                    if($person->getPeopleSoftEmail()!=$peopleSoftEmail and !$noEmail)$person->setPeopleSoftEmail($peopleSoftEmail);
                                    if($person->getPeopleSoftUserName()!=$peopleSoftUserName and !$noEmail)$person->setPeopleSoftUserName($peopleSoftUserName);
                                    if($person->getPhone()!=$phone and $phone!= null)$person->setPhone($phone);
                                    if($person->getGender()!=$gender and $gender != null)$person->setGender($gender);
                                }else{
                                    $person = new Person($firstName, $secondName, $lastName1, $lastName2, $documentType, $documentNumber, $peopleSoftEmail,$peopleSoftUserName, $phone, $gender);
                                }
                            }else{
                                continue;
                            }
                            $studentCode = $data[$count][0];
                            $student = $manager->getRepository("AppBundle:Student")->findOneBy(array('studentCode' => $studentCode));
                            if($student == null) {
                                $student = new Student(null, $studentCode);
                                $person->getPersonRole()->first();
                                $person->addPersonRole($student);
                            }
                            $manager->persist($person);
                            if(!$faculty->hasStudent($student)){
                                $faculty->addRole($student);
                                $manager->persist($faculty);
                            }
                            $manager->flush();
                            $manager->clear();
                        }else{
                            echo 'faculty with code: DPT-ISIST not found.'.PHP_EOL;
                            continue;
                        }
                    }
                    if($count % 200 == 0){
                        echo "\033[0;33m  >\033[0;32m loading [4] Students..".$file.' '.$count."\033[0;00m".PHP_EOL;
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
        return 4;
    }
}
?> 
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
use AppBundle\Entity\FacultyHasCourses;
use AppBundle\Entity\FacultyHasTeachers;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadInitialData extends AbstractFixture implements OrderedFixtureInterface
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
         * ║ Modulo QA Catálogo y Programación                             ║
         * ║ División 1 Catálogo y Sylabus                                 ║
         * ║ Opcion 5 Componentes de asignatura                            ║
         * ║ Parametros de la consulta                                     ║
         * ║ Institucion académica  PUJAV                                  ║
         * ║ ------------------------------------------------------------- ║
         * ║ Se debe generar el archivo csv o xlsx                         ║
         * ║ Una vez generado el archivo guardarlo en el directorio:       ║
         * ║ /web/uploads/Courses/files                                    ║
         * ╚═══════════════════════════════════════════════════════════════╝
         */
        $manager->getConnection()->getConfiguration()->setSQLLogger(null);
        echo "  > Memory usage before: " . (memory_get_usage()/1048576) . " MB" . PHP_EOL;
        $dir = "web/uploads/Files/Faculty";
        foreach (scandir($dir) as $file) {
            if ('.' === $file || '..' === $file) continue;
            $inputFileType = \PHPExcel_IOFactory::identify($dir . '/' . $file);
            if($inputFileType!='CSV'){
                $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
                /** @var \PHPExcel $obj */
                $obj = $objReader->load($dir . '/' . $file);
                echo "  > loading [1] Faculties and Courses". PHP_EOL;
                /** @var \PHPExcel_Worksheet $worksheet */
                foreach ($obj->getWorksheetIterator() as $worksheet){
                    $rowCount = 1;
                    /** @var \PHPExcel_Worksheet_Row $row */
                    foreach ($worksheet->getRowIterator() as $row){
                        if($rowCount>1){
                            $facultyCode = $worksheet->getCellByColumnAndRow(1,$rowCount)->getValue();
                            /** @var Faculty $faculty */
                            $faculty = $manager->getRepository("AppBundle:Faculty")->findOneBy(array('facultyCode'=>$facultyCode));
                            if(!$faculty){
                                $faculty = new Faculty();
                                $faculty->setName($worksheet->getCellByColumnAndRow(2,$rowCount));
                                $faculty->setFacultyCode($facultyCode);
                                $manager->persist($faculty);
                                $manager->flush();
                            }
                            $courseCode = $worksheet->getCellByColumnAndRow(4, $rowCount)->getValue();
                            /** @var Course $course */
                            $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode' => $courseCode));
                            if($faculty and !$course){
                                $course = new Course();
                                $course->setCourseCode($courseCode);
                                $course->setAcademicGrade($worksheet->getCellByColumnAndRow(0, $rowCount)->getValue());
                                $course->setCreatedAt(new \DateTime());
                                $course->setCredits($worksheet->getCellByColumnAndRow(7, $rowCount)->getValue());
                                $course->setNameCourse($worksheet->getCellByColumnAndRow(5, $rowCount)->getValue());
                                $course->setShortNameCourse($worksheet->getCellByColumnAndRow(6, $rowCount)->getValue());
                                $facultyHasCourse = new FacultyHasCourses();
                                $facultyHasCourse->setCourseCourse($course);
                                $facultyHasCourse->setFacultyFaculty($faculty);
                                $faculty->addFacultyHasCourse($facultyHasCourse);
                                $course->addCourseHasfaculty($facultyHasCourse);
                                $manager->persist($facultyHasCourse);
                                $manager->flush();
                            }elseif($faculty and $course and ! $manager->getRepository("AppBundle:FacultyHasCourses")->findOneBy(
                                array(
                                    'facultyFaculty'=>$faculty,
                                    'courseCourse'=>$course
                                ))){
                                $facultyHasCourse = new FacultyHasCourses();
                                $facultyHasCourse->setCourseCourse($course);
                                $facultyHasCourse->setFacultyFaculty($faculty);
                                $faculty->addFacultyHasCourse($facultyHasCourse);
                                $course->addCourseHasfaculty($facultyHasCourse);
                                $manager->persist($facultyHasCourse);
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
                            $manager->clear();
                        }
                        if($rowCount%2000 == 0){
                            echo '  > loading [1] Faculties and Courses..'.$rowCount.PHP_EOL;
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
        return 1;
    }
}
?> 
<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 30/03/17
 * Time: 11:44 AM
 */

namespace AppBundle\Traits;


use AppBundle\Entity\Course;
use AppBundle\Entity\Faculty;
use AppBundle\Entity\Teacher;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\QueryBuilder;

trait PlatformMethodTrait
{

    /**
     * @return ObjectManager
     */
    public function getManager(){
        return $this->getDoctrine()->getManager();
    }

    /**
     * Returns app platform
     * @return \AppBundle\Entity\Platform|null|object
     */
    public function getPlatform(){
        /** @var ObjectManager $em */
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository("AppBundle:Platform")->find(1);
    }

    /**
     * finds Faculty by code
     * @param $facultyCode
     * @return Faculty|null
     */
    public function getFacultyByCode($facultyCode){
        /** @var ObjectManager $em */
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository("AppBundle:Faculty")->findOneBy(array('facultyCode'=>$facultyCode));
    }

    public function getLastCourse(Faculty $faculty){
        /** @var ObjectManager $em */
        $em = $this->getDoctrine()->getManager();
        /** @var QueryBuilder $query */
        $query = $em->createQueryBuilder();
        $query
            ->select('c,MAX(c.createdAt) AS max_score')
            ->from("AppBundle:Course",'c')
            ->join('c.faculties','f')
            ->where($query->expr()->eq('f.idFaculty',$faculty->getIdFaculty()))
            ->andWhere('c.academicGrade = ?1')
            ->setParameter('1','PREG')
            ->groupBy('c.idCourse')
            ->setMaxResults(1)
            ->orderBy('max_score','DESC');
        return $query->getQuery()->getResult()[0][0];
    }

    public function getLastTeacher($faculty){
        /** @var ObjectManager $em */
        $em = $this->getDoctrine()->getManager();
        /** @var QueryBuilder $query2 */
        $query2 = $em->createQueryBuilder();
        $query2
            ->select('t,MAX(t.createdAt) AS max_score')
            ->from("AppBundle:Teacher",'t')
            ->join('t.faculties','f')
            ->where($query2->expr()->eq('f.idFaculty',$faculty->getIdFaculty()))
            ->groupBy('t.idRole')
            ->setMaxResults(1)
            ->orderBy('max_score','DESC');
        return $query2->getQuery()->getResult()[0][0];
    }

    public function getActiveClasses(Faculty $faculty)
    {
        $em = $this->getManager();
        /** @var QueryBuilder $query */
        $query = $em->createQueryBuilder();
            $query->select('cl');
            $query
                ->from("AppBundle:ClassCourse",'cl')
                ->join('cl.course','c')
                ->join('c.faculties','f')
                ->where('cl.activePeriod = ?1')
                ->andWhere('f.idFaculty = ?2')
                ->andWhere('c.academicGrade = ?3')
                ->setParameter('3','PREG')
                ->setParameter('1',$this->getPlatform()->getActivePeriod())
                ->setParameter('2',$faculty->getIdFaculty());
        return $query->getQuery()->getResult();
    }

    public function getActiveTeachers(Faculty $faculty)
    {
        $em = $this->getManager();
        /** @var QueryBuilder $query */
        $query = $em->createQueryBuilder();
        $query->select('t');
        $query
            ->from('AppBundle:Teacher','t')
            ->join('t.classCourses','cl')
            ->join('cl.course','c')
            ->join('t.faculties','f')
            ->where('cl.activePeriod = ?1')
            ->andWhere('f.idFaculty = ?2')
            ->andWhere('c.academicGrade = ?3')
            ->groupBy('t.idRole')
            ->setParameter('1',$this->getPlatform()->getActivePeriod())
            ->setParameter('2',$faculty->getIdFaculty())
            ->setParameter('3','PREG');
        return $query->getQuery()->getResult();
    }

    public function getAllTeacherActiveClasses(Teacher $teacher)
    {
        $em = $this->getManager();
        /** @var QueryBuilder $query */
        $query = $em->createQueryBuilder();
        $query->select('cl');
        $query
            ->from('AppBundle:ClassCourse','cl')
            ->join('cl.roles','r')
            ->join('cl.course','c')
            ->where('cl.activePeriod = ?1')
            ->andWhere('r.idRole = ?2')
            ->andWhere('c.academicGrade = ?3')
            ->setParameter('3','PREG')
            ->setParameter('1',$this->getPlatform()->getActivePeriod())
            ->setParameter('2',$teacher->getIdRole());
        return $query->getQuery()->getResult();
    }

    public function getAllTeacherClasses(Teacher $teacher)
    {
        $em = $this->getManager();
        /** @var QueryBuilder $query */
        $query = $em->createQueryBuilder();
        $query->select('cl');
        $query
            ->from('AppBundle:ClassCourse','cl')
            ->join('cl.roles','r')
            ->join('cl.course','c')
            ->where('r.idRole = ?1')
            ->andWhere('c.academicGrade = ?2')
            ->setParameter('1',$teacher->getIdRole())
            ->setParameter('2','PREG');
        return $query->getQuery()->getResult();
    }
    
    public function getCourseActiveClassesByTeacher(Course $course,Teacher $teacher)
    {
        $em = $this->getManager();
        /** @var QueryBuilder $query */
        $query = $em->createQueryBuilder();
        $query->select('cl');
        $query
            ->from('AppBundle:ClassCourse','cl')
            ->join('cl.roles','r')
            ->join('cl.course','c')
            ->where('r.idRole = ?1')
            ->andWhere('c.idCourse = ?2')
            ->andWhere('cl.activePeriod = ?3')
            ->setParameter('1',$teacher->getIdRole())
            ->setParameter('2',$course->getIdCourse())
            ->setParameter('3',$this->getPlatform()->getActivePeriod());
        return $query->getQuery()->getResult();
    }

    public function getCourseClassesByTeacher(Course $course,Teacher $teacher)
    {
        $em = $this->getManager();
        /** @var QueryBuilder $query */
        $query = $em->createQueryBuilder();
        $query->select('cl');
        $query
            ->from('AppBundle:ClassCourse','cl')
            ->join('cl.roles','r')
            ->join('cl.course','c')
            ->where('r.idRole = ?1')
            ->andWhere('c.idCourse = ?2')
            ->setParameter('1',$teacher->getIdRole())
            ->setParameter('2',$course->getIdCourse());
        return $query->getQuery()->getResult();
    }


}
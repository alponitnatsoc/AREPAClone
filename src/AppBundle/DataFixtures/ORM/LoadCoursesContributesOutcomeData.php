<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 29/09/16
 * Time: 10:27 PM
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\ContentContributesOutcome;
use AppBundle\Entity\CourseContributesOutcome;
use AppBundle\Entity\Outcome;
use AppBundle\Entity\RoleType;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCoursesContributesOutcomeData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $outcomeA = $manager->getRepository("AppBundle:Outcome")->findOneBy(array('nameOutcome'=>'(a)'));
        $outcomeB = $manager->getRepository("AppBundle:Outcome")->findOneBy(array('nameOutcome'=>'(b)'));
        $outcomeC = $manager->getRepository("AppBundle:Outcome")->findOneBy(array('nameOutcome'=>'(c)'));
        $outcomeD = $manager->getRepository("AppBundle:Outcome")->findOneBy(array('nameOutcome'=>'(d)'));
        $outcomeE = $manager->getRepository("AppBundle:Outcome")->findOneBy(array('nameOutcome'=>'(e)'));
        $outcomeF = $manager->getRepository("AppBundle:Outcome")->findOneBy(array('nameOutcome'=>'(f)'));
        $outcomeG = $manager->getRepository("AppBundle:Outcome")->findOneBy(array('nameOutcome'=>'(g)'));
        $outcomeH = $manager->getRepository("AppBundle:Outcome")->findOneBy(array('nameOutcome'=>'(h)'));
        $outcomeI = $manager->getRepository("AppBundle:Outcome")->findOneBy(array('nameOutcome'=>'(i)'));
        $outcomeJ = $manager->getRepository("AppBundle:Outcome")->findOneBy(array('nameOutcome'=>'(j)'));
        $outcomeK = $manager->getRepository("AppBundle:Outcome")->findOneBy(array('nameOutcome'=>'(k)'));

        $period = $manager->getRepository("AppBundle:Period")->findOneBy(array('code'=>'1630'));

        // Outcome A
        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004206'));
        $courseContributesOutcome = new CourseContributesOutcome();
        $courseContributesOutcome->setOutcomeOutcome($outcomeA);
        $courseContributesOutcome->setCourseCourse($course);
        $courseContributesOutcome->setBloomLevel(1);
        $courseContributesOutcome->setPeriod($period);
        $outcomeA->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004196'));
        $courseContributesOutcome = new CourseContributesOutcome();
        $courseContributesOutcome->setOutcomeOutcome($outcomeA);
        $courseContributesOutcome->setCourseCourse($course);
        $courseContributesOutcome->setBloomLevel(2);
        $courseContributesOutcome->setPeriod($period);
        $outcomeA->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'003194'));
        $courseContributesOutcome = new CourseContributesOutcome();
        $courseContributesOutcome->setOutcomeOutcome($outcomeA);
        $courseContributesOutcome->setCourseCourse($course);
        $courseContributesOutcome->setBloomLevel(3);
        $courseContributesOutcome->setPeriod($period);
        $outcomeA->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'022586'));
        $courseContributesOutcome = new CourseContributesOutcome();
        $courseContributesOutcome->setOutcomeOutcome($outcomeA);
        $courseContributesOutcome->setCourseCourse($course);
        $courseContributesOutcome->setBloomLevel(3);
        $courseContributesOutcome->setPeriod($period);
        $outcomeA->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        // Outcome B
        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004210'));
        $courseContributesOutcome = new CourseContributesOutcome();
        $courseContributesOutcome->setOutcomeOutcome($outcomeB);
        $courseContributesOutcome->setCourseCourse($course);
        $courseContributesOutcome->setBloomLevel(1);
        $courseContributesOutcome->setPeriod($period);
        $outcomeB->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004196'));
        $courseContributesOutcome = new CourseContributesOutcome();
        $courseContributesOutcome->setOutcomeOutcome($outcomeB);
        $courseContributesOutcome->setCourseCourse($course);
        $courseContributesOutcome->setBloomLevel(2);
        $courseContributesOutcome->setPeriod($period);
        $outcomeB->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004085'));
        $courseContributesOutcome = new CourseContributesOutcome();
        $courseContributesOutcome->setOutcomeOutcome($outcomeB);
        $courseContributesOutcome->setCourseCourse($course);
        $courseContributesOutcome->setBloomLevel(3);
        $courseContributesOutcome->setPeriod($period);
        $outcomeB->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004070'));
        $courseContributesOutcome = new CourseContributesOutcome();
        $courseContributesOutcome->setOutcomeOutcome($outcomeB);
        $courseContributesOutcome->setCourseCourse($course);
        $courseContributesOutcome->setBloomLevel(3);
        $courseContributesOutcome->setPeriod($period);
        $outcomeB->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        // Outcome C
        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004183'));
        $courseContributesOutcome = new CourseContributesOutcome();
        $courseContributesOutcome->setOutcomeOutcome($outcomeC);
        $courseContributesOutcome->setCourseCourse($course);
        $courseContributesOutcome->setBloomLevel(1);
        $courseContributesOutcome->setPeriod($period);
        $outcomeC->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004082'));
        $courseContributesOutcome = new CourseContributesOutcome();
        $courseContributesOutcome->setOutcomeOutcome($outcomeC);
        $courseContributesOutcome->setCourseCourse($course);
        $courseContributesOutcome->setBloomLevel(2);
        $courseContributesOutcome->setPeriod($period);
        $outcomeC->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004070'));
        $courseContributesOutcome = new CourseContributesOutcome();
        $courseContributesOutcome->setOutcomeOutcome($outcomeC);
        $courseContributesOutcome->setCourseCourse($course);
        $courseContributesOutcome->setBloomLevel(3);
        $courseContributesOutcome->setPeriod($period);
        $outcomeC->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        // Outcome D
        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004075'));
        $courseContributesOutcome = new CourseContributesOutcome();
        $courseContributesOutcome->setOutcomeOutcome($outcomeD);
        $courseContributesOutcome->setCourseCourse($course);
        $courseContributesOutcome->setBloomLevel(1);
        $courseContributesOutcome->setPeriod($period);
        $outcomeD->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004082'));
        $courseContributesOutcome = new CourseContributesOutcome();
        $courseContributesOutcome->setOutcomeOutcome($outcomeD);
        $courseContributesOutcome->setCourseCourse($course);
        $courseContributesOutcome->setBloomLevel(2);
        $courseContributesOutcome->setPeriod($period);
        $outcomeD->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004064'));
        $courseContributesOutcome = new CourseContributesOutcome();
        $courseContributesOutcome->setOutcomeOutcome($outcomeD);
        $courseContributesOutcome->setCourseCourse($course);
        $courseContributesOutcome->setBloomLevel(3);
        $courseContributesOutcome->setPeriod($period);
        $outcomeD->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        // Outcome E
        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004196'));
        $courseContributesOutcome = new CourseContributesOutcome();
        $courseContributesOutcome->setOutcomeOutcome($outcomeE);
        $courseContributesOutcome->setCourseCourse($course);
        $courseContributesOutcome->setBloomLevel(1);
        $courseContributesOutcome->setPeriod($period);
        $outcomeE->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004190'));
        $courseContributesOutcome = new CourseContributesOutcome();
        $courseContributesOutcome->setOutcomeOutcome($outcomeE);
        $courseContributesOutcome->setCourseCourse($course);
        $courseContributesOutcome->setBloomLevel(2);
        $courseContributesOutcome->setPeriod($period);
        $outcomeE->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004185'));
        $courseContributesOutcome = new CourseContributesOutcome();
        $courseContributesOutcome->setOutcomeOutcome($outcomeE);
        $courseContributesOutcome->setCourseCourse($course);
        $courseContributesOutcome->setBloomLevel(3);
        $courseContributesOutcome->setPeriod($period);
        $outcomeE->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        // Outcome F
        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004071'));
        $courseContributesOutcome = new CourseContributesOutcome();
        $courseContributesOutcome->setOutcomeOutcome($outcomeF);
        $courseContributesOutcome->setCourseCourse($course);
        $courseContributesOutcome->setBloomLevel(1);
        $courseContributesOutcome->setPeriod($period);
        $outcomeF->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004064'));
        $courseContributesOutcome = new CourseContributesOutcome();
        $courseContributesOutcome->setOutcomeOutcome($outcomeF);
        $courseContributesOutcome->setCourseCourse($course);
        $courseContributesOutcome->setBloomLevel(2);
        $courseContributesOutcome->setPeriod($period);
        $outcomeF->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'005100'));
        $courseContributesOutcome = new CourseContributesOutcome();
        $courseContributesOutcome->setOutcomeOutcome($outcomeF);
        $courseContributesOutcome->setCourseCourse($course);
        $courseContributesOutcome->setBloomLevel(3);
        $courseContributesOutcome->setPeriod($period);
        $outcomeF->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        // Outcome G
        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004071'));
        $courseContributesOutcome = new CourseContributesOutcome();
        $courseContributesOutcome->setOutcomeOutcome($outcomeG);
        $courseContributesOutcome->setCourseCourse($course);
        $courseContributesOutcome->setBloomLevel(1);
        $courseContributesOutcome->setPeriod($period);
        $outcomeG->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004190'));
        $courseContributesOutcome = new CourseContributesOutcome();
        $courseContributesOutcome->setOutcomeOutcome($outcomeG);
        $courseContributesOutcome->setCourseCourse($course);
        $courseContributesOutcome->setBloomLevel(2);
        $courseContributesOutcome->setPeriod($period);
        $outcomeG->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'022469'));
        $courseContributesOutcome = new CourseContributesOutcome();
        $courseContributesOutcome->setOutcomeOutcome($outcomeG);
        $courseContributesOutcome->setCourseCourse($course);
        $courseContributesOutcome->setBloomLevel(3);
        $courseContributesOutcome->setPeriod($period);
        $outcomeG->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        // Outcome H
        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004075'));
        $courseContributesOutcome = new CourseContributesOutcome();
        $courseContributesOutcome->setOutcomeOutcome($outcomeH);
        $courseContributesOutcome->setCourseCourse($course);
        $courseContributesOutcome->setBloomLevel(1);
        $courseContributesOutcome->setPeriod($period);
        $outcomeH->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'015838'));
        $courseContributesOutcome = new CourseContributesOutcome();
        $courseContributesOutcome->setOutcomeOutcome($outcomeH);
        $courseContributesOutcome->setCourseCourse($course);
        $courseContributesOutcome->setBloomLevel(2);
        $courseContributesOutcome->setPeriod($period);
        $outcomeH->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'022469'));
        $courseContributesOutcome = new CourseContributesOutcome();
        $courseContributesOutcome->setOutcomeOutcome($outcomeH);
        $courseContributesOutcome->setCourseCourse($course);
        $courseContributesOutcome->setBloomLevel(3);
        $courseContributesOutcome->setPeriod($period);
        $outcomeH->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        // Outcome I
        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004208'));
        $courseContributesOutcome = new CourseContributesOutcome();
        $courseContributesOutcome->setOutcomeOutcome($outcomeI);
        $courseContributesOutcome->setCourseCourse($course);
        $courseContributesOutcome->setBloomLevel(1);
        $courseContributesOutcome->setPeriod($period);
        $outcomeI->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004204'));
        $courseContributesOutcome = new CourseContributesOutcome();
        $courseContributesOutcome->setOutcomeOutcome($outcomeI);
        $courseContributesOutcome->setCourseCourse($course);
        $courseContributesOutcome->setBloomLevel(2);
        $courseContributesOutcome->setPeriod($period);
        $outcomeI->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'015838'));
        $courseContributesOutcome = new CourseContributesOutcome();
        $courseContributesOutcome->setOutcomeOutcome($outcomeI);
        $courseContributesOutcome->setCourseCourse($course);
        $courseContributesOutcome->setBloomLevel(3);
        $courseContributesOutcome->setPeriod($period);
        $outcomeI->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        // Outcome J
        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004075'));
        $courseContributesOutcome = new CourseContributesOutcome();
        $courseContributesOutcome->setOutcomeOutcome($outcomeJ);
        $courseContributesOutcome->setCourseCourse($course);
        $courseContributesOutcome->setBloomLevel(1);
        $courseContributesOutcome->setPeriod($period);
        $outcomeJ->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004064'));
        $courseContributesOutcome = new CourseContributesOutcome();
        $courseContributesOutcome->setOutcomeOutcome($outcomeJ);
        $courseContributesOutcome->setCourseCourse($course);
        $courseContributesOutcome->setBloomLevel(2);
        $courseContributesOutcome->setPeriod($period);
        $outcomeJ->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'005100'));
        $courseContributesOutcome = new CourseContributesOutcome();
        $courseContributesOutcome->setOutcomeOutcome($outcomeJ);
        $courseContributesOutcome->setCourseCourse($course);
        $courseContributesOutcome->setBloomLevel(3);
        $courseContributesOutcome->setPeriod($period);
        $outcomeJ->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        // Outcome K
        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004208'));
        $courseContributesOutcome = new CourseContributesOutcome();
        $courseContributesOutcome->setOutcomeOutcome($outcomeK);
        $courseContributesOutcome->setCourseCourse($course);
        $courseContributesOutcome->setBloomLevel(1);
        $courseContributesOutcome->setPeriod($period);
        $outcomeK->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004186'));
        $courseContributesOutcome = new CourseContributesOutcome();
        $courseContributesOutcome->setOutcomeOutcome($outcomeK);
        $courseContributesOutcome->setCourseCourse($course);
        $courseContributesOutcome->setBloomLevel(2);
        $courseContributesOutcome->setPeriod($period);
        $outcomeK->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'022586'));
        $courseContributesOutcome = new CourseContributesOutcome();
        $courseContributesOutcome->setOutcomeOutcome($outcomeK);
        $courseContributesOutcome->setCourseCourse($course);
        $courseContributesOutcome->setBloomLevel(3);
        $courseContributesOutcome->setPeriod($period);
        $outcomeK->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004185'));
        $courseContributesOutcome = new CourseContributesOutcome();
        $courseContributesOutcome->setOutcomeOutcome($outcomeK);
        $courseContributesOutcome->setCourseCourse($course);
        $courseContributesOutcome->setBloomLevel(4);
        $courseContributesOutcome->setPeriod($period);
        $outcomeK->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $manager->flush();

    }

    public function getOrder()
    {
        return 2;
    }
}
?> 
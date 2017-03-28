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

        $outcomeA = $manager->getRepository("AppBundle:Outcome")->findOneBy(array('name'=>'(a)'));
        $outcomeB = $manager->getRepository("AppBundle:Outcome")->findOneBy(array('name'=>'(b)'));
        $outcomeC = $manager->getRepository("AppBundle:Outcome")->findOneBy(array('name'=>'(c)'));
        $outcomeD = $manager->getRepository("AppBundle:Outcome")->findOneBy(array('name'=>'(d)'));
        $outcomeE = $manager->getRepository("AppBundle:Outcome")->findOneBy(array('name'=>'(e)'));
        $outcomeF = $manager->getRepository("AppBundle:Outcome")->findOneBy(array('name'=>'(f)'));
        $outcomeG = $manager->getRepository("AppBundle:Outcome")->findOneBy(array('name'=>'(g)'));
        $outcomeH = $manager->getRepository("AppBundle:Outcome")->findOneBy(array('name'=>'(h)'));
        $outcomeI = $manager->getRepository("AppBundle:Outcome")->findOneBy(array('name'=>'(i)'));
        $outcomeJ = $manager->getRepository("AppBundle:Outcome")->findOneBy(array('name'=>'(j)'));
        $outcomeK = $manager->getRepository("AppBundle:Outcome")->findOneBy(array('name'=>'(k)'));

        $period = $manager->getRepository("AppBundle:Period")->findOneBy(array('code'=>'1710'));

        $bloomLevel1 = $manager->getRepository("AppBundle:BloomLevel")->find(1);
        $bloomLevel2 = $manager->getRepository("AppBundle:BloomLevel")->find(2);
        $bloomLevel3 = $manager->getRepository("AppBundle:BloomLevel")->find(3);

        $activePeriod = $manager->getRepository("AppBundle:Plataform")->find(1)->getActivePeriod();

        // Outcome A
        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004206'));
        $courseContributesOutcome = new CourseContributesOutcome($bloomLevel1,$activePeriod,$course,0.1);
        $outcomeA->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004196'));
        $courseContributesOutcome = new CourseContributesOutcome($bloomLevel2,$activePeriod,$course,0.1);
        $outcomeA->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'003194'));
        $courseContributesOutcome = new CourseContributesOutcome($bloomLevel3,$activePeriod,$course,0.1);
        $outcomeA->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'022586'));
        $courseContributesOutcome = new CourseContributesOutcome($bloomLevel3,$activePeriod,$course,0.1);
        $outcomeA->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        // Outcome B
        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004210'));
        $courseContributesOutcome = new CourseContributesOutcome($bloomLevel1,$activePeriod,$course,0.1);
        $outcomeB->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004196'));
        $courseContributesOutcome = new CourseContributesOutcome($bloomLevel2,$activePeriod,$course,0.1);
        $outcomeB->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004085'));
        $courseContributesOutcome = new CourseContributesOutcome($bloomLevel3,$activePeriod,$course,0.1);
        $outcomeB->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004070'));
        $courseContributesOutcome = new CourseContributesOutcome($bloomLevel3,$activePeriod,$course,0.1);
        $outcomeB->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        // Outcome C
        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004183'));
        $courseContributesOutcome = new CourseContributesOutcome($bloomLevel1,$activePeriod,$course,0.1);
        $outcomeC->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004082'));
        $courseContributesOutcome = new CourseContributesOutcome($bloomLevel2,$activePeriod,$course,0.1);
        $outcomeC->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004070'));
        $courseContributesOutcome = new CourseContributesOutcome($bloomLevel3,$activePeriod,$course,0.1);
        $outcomeC->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        // Outcome D
        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004075'));
        $courseContributesOutcome = new CourseContributesOutcome($bloomLevel1,$activePeriod,$course,0.1);
        $outcomeD->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004082'));
        $courseContributesOutcome = new CourseContributesOutcome($bloomLevel2,$activePeriod,$course,0.1);
        $outcomeD->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004064'));
        $courseContributesOutcome = new CourseContributesOutcome($bloomLevel3,$activePeriod,$course,0.1);
        $outcomeD->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        // Outcome E
        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004196'));
        $courseContributesOutcome = new CourseContributesOutcome($bloomLevel1,$activePeriod,$course,0.1);
        $outcomeE->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004190'));
        $courseContributesOutcome = new CourseContributesOutcome($bloomLevel2,$activePeriod,$course,0.1);
        $outcomeE->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004185'));
        $courseContributesOutcome = new CourseContributesOutcome($bloomLevel3,$activePeriod,$course,0.1);
        $outcomeE->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        // Outcome F
        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004071'));
        $courseContributesOutcome = new CourseContributesOutcome($bloomLevel1,$activePeriod,$course,0.1);
        $outcomeF->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004064'));
        $courseContributesOutcome = new CourseContributesOutcome($bloomLevel2,$activePeriod,$course,0.1);
        $outcomeF->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'005100'));
        $courseContributesOutcome = new CourseContributesOutcome($bloomLevel3,$activePeriod,$course,0.1);
        $outcomeF->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        // Outcome G
        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004071'));
        $courseContributesOutcome = new CourseContributesOutcome($bloomLevel1,$activePeriod,$course,0.1);
        $outcomeG->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004190'));
        $courseContributesOutcome = new CourseContributesOutcome($bloomLevel2,$activePeriod,$course,0.1);
        $outcomeG->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'022469'));
        $courseContributesOutcome = new CourseContributesOutcome($bloomLevel3,$activePeriod,$course,0.1);
        $outcomeG->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        // Outcome H
        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004075'));
        $courseContributesOutcome = new CourseContributesOutcome($bloomLevel1,$activePeriod,$course,0.1);
        $outcomeH->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'015838'));
        $courseContributesOutcome = new CourseContributesOutcome($bloomLevel2,$activePeriod,$course,0.1);
        $outcomeH->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'022469'));
        $courseContributesOutcome = new CourseContributesOutcome($bloomLevel3,$activePeriod,$course,0.1);
        $outcomeH->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        // Outcome I
        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004208'));
        $courseContributesOutcome = new CourseContributesOutcome($bloomLevel1,$activePeriod,$course,0.1);
        $outcomeI->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004204'));
        $courseContributesOutcome = new CourseContributesOutcome($bloomLevel2,$activePeriod,$course,0.1);
        $outcomeI->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'015838'));
        $courseContributesOutcome = new CourseContributesOutcome($bloomLevel3,$activePeriod,$course,0.1);
        $outcomeI->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        // Outcome J
        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004075'));
        $courseContributesOutcome = new CourseContributesOutcome($bloomLevel1,$activePeriod,$course,0.1);
        $outcomeJ->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004064'));
        $courseContributesOutcome = new CourseContributesOutcome($bloomLevel2,$activePeriod,$course,0.1);
        $outcomeJ->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'005100'));
        $courseContributesOutcome = new CourseContributesOutcome($bloomLevel3,$activePeriod,$course,0.1);
        $outcomeJ->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        // Outcome K
        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004208'));
        $courseContributesOutcome = new CourseContributesOutcome($bloomLevel1,$activePeriod,$course,0.1);
        $outcomeK->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004186'));
        $courseContributesOutcome = new CourseContributesOutcome($bloomLevel2,$activePeriod,$course,0.1);
        $outcomeK->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'022586'));
        $courseContributesOutcome = new CourseContributesOutcome($bloomLevel3,$activePeriod,$course,0.1);
        $outcomeK->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);

        $course = $manager->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>'004185'));
        $courseContributesOutcome = new CourseContributesOutcome($bloomLevel3,$activePeriod,$course,0.1);
        $outcomeK->addCourseContributesOutcome($courseContributesOutcome);
        $manager->persist($courseContributesOutcome);
        $manager->flush();

    }

    public function getOrder()
    {
        return 4;
    }
}
?> 
<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AssessmentTool;
use AppBundle\Entity\Course;
use AppBundle\Entity\CourseContributesOutcome;
use AppBundle\Entity\Rubric;
use AppBundle\Entity\Teacher;
use AppBundle\Entity\TeacherDictatesClassCourse;
use AppBundle\Entity\TeacherDictatesCourse;
use AppBundle\Entity\User;
use AppBundle\Form\assessmentToolType;
use AppBundle\Form\NewAssessmentTool;
use AppBundle\Form\NewRubric;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class CourseController extends Controller
{
    public function showCourseInfoAction($courseCode,Request $request)
    {
        if($this->isGranted('ROLE_ADMIN')){

        }
        if($this->isGranted('ROLE_TEACHER')){
            $em = $this->getDoctrine()->getManager();
            /** @var Course $course */
            $course = $em->getRepository("AppBundle:Course")->findOneBy(array('courseCode'=>$courseCode));
            if(!$course){
                $this->createNotFoundException();
            }
            if(count($course->getActiveCourseContributesOutcomes($this->getActivePeriod()))>0){
                $course->setContributeOutcome(true);
                $em->persist($course);
                $em->flush();
            }else{
                $course->setContributeOutcome(false);
                $em->persist($course);
                $em->flush();
            }
            /** @var User $user */
            $user = $this->getUser();
            /** @var Teacher $teacher */
            $teacher = $user->getPersonPerson()->getTeacher();
            /** @var TeacherDictatesCourse $tdc */
            $tdc = $teacher->getTeacherDictatesCourseByCourse($course)->first();
            $myRubrics = $course->getRubricsByTeacherDictatesCourse($tdc);
            $otherRubrics = $course->getRubricsNotMatchingTeacherDictatesCourse($tdc);
            $tdcls = $tdc->getClasses();
            $activeClasses = array();
            /** @var TeacherDictatesClassCourse $tdcl */
            foreach ($tdcls as $tdcl) {
                if($tdcl->getClassClass()->getActivePeriod()==$this->getActivePeriod()->getCode()){
                    $activeClasses[]=$tdcl->getClassClass();
                }
            }

            $period = $this->getActivePeriod();

            $formRubric = $this->createForm(NewRubric::class,null,array(
                'course'=>$course,
                'period'=>$period,
            ));

            $formRubric->handleRequest($request);
            if($formRubric->isSubmitted() and $formRubric->isValid()){

            }

            return $this->render('@App/Teacher/teacher_course.html.twig',array(
                'courseContributesOutcomes'=>$course->getActiveCourseContributesOutcomes($this->getActivePeriod()),
                'course'=>$course,
                'activeClasses'=>$activeClasses,
                'teacherDictatesCourse'=>$tdc,
                'myRubrics'=>$myRubrics,
                'otherRubrics'=>$otherRubrics,
                'formRubric'=>$formRubric->createView(),
//                'editRubric'=>$editRubric,
            ));


        }else{
            $this->createAccessDeniedException();
        }
        $this->redirectToRoute('dashboard',array(),307);
    }

    protected Function getActivePeriod(){
        return $this->getDoctrine()->getRepository('AppBundle:Period')->findOneBy(array(
            'code'=>$this->getDoctrine()->getRepository('AppBundle:Plataform')->find(1)->getActivePeriod(),
        ));
    }

}

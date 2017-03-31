<?php
/**
 * Created by PhpStorm.
 * User: erikaxu
 * Date: 22/09/16
 * Time: 03:38 PM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Platform;
use AppBundle\Entity\Teacher;
use AppBundle\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Traits\PlatformMethodTrait;

class TeacherController extends Controller
{
    use PlatformMethodTrait;

    public function teacherDashboardAction($type = 0, Request $request)
    {
        if($this->isGranted('ROLE_TEACHER')){
            /** @var ObjectManager $em */
            $em = $this->getManager();
            /** @var Platform $platform */
            $platform = $this->getPlatform();
            /** @var User $user */
            $user = $this->getUser();
            /** @var Teacher $teacher */
            $teacher = $user->getPersonPerson()->getTeacher();
            $courses = $teacher->getPregCourses();
            $activeCourses = $teacher->getActiveCourses($platform->getActivePeriod());
            $classes = $this->getAllTeacherClasses($teacher);
            $activeClass = $this->getAllTeacherActiveClasses($teacher);
            return $this->redirectByType($type,$courses,$activeCourses,$classes,$activeClass);
        }else{
            $this->createAccessDeniedException();
        }
        $this->redirectToRoute('dashboard',array(),307);
    }

    private function redirectByType($type,$courses,$activeCourses,$classes,$activeClass)
    {
        switch ($type){
            case 0:
                return $this->render('@App/Teacher/teacher_dashboard.html.twig',array(
                    'courses'=>$courses,
                    'activeCourses'=>$activeCourses,
                    'activeClasses'=>$activeClass,
                    'classes'=>$classes
                ));
                break;
            case 1:
                return $this->render('@App/Teacher/teacher_courses.html.twig',array(
                    'courses'=>$courses,
                    'activeCourses'=>$activeCourses,
                    'activeClasses'=>$activeClass,
                    'classes'=>$classes
                ));
                break;
            case 2:
                return $this->render('@App/Teacher/teacher_active_classes.html.twig',array(
                    'courses'=>$courses,
                    'activeCourses'=>$activeCourses,
                    'activeClasses'=>$activeClass,
                    'classes'=>$classes
                ));
                break;
            case 3:
                return $this->render('@App/Teacher/teacher_classes.html.twig',array(
                    'courses'=>$courses,
                    'activeCourses'=>$activeCourses,
                    'activeClasses'=>$activeClass,
                    'classes'=>$classes
                ));
                break;
        }

    }

}
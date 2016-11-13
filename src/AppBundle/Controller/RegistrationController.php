<?php

namespace AppBundle\Controller;

use AppBundle\Entity\RoleType;
use AppBundle\Entity\TeacherHasRole;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Form\Factory\FactoryInterface;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RegistrationController extends BaseController
{

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function registerAction(Request $request)
    {
        if($this->isGranted('IS_AUTHENTICATED_FULLY')){
            return new RedirectResponse($this->generateUrl('dashboard'), 307);
        }

        /** @var $formFactory FactoryInterface */
        $formFactory = $this->get('fos_user.registration.form.factory');
        /** @var $userManager UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');
        /** @var $dispatcher EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $user = $userManager->createUser();
        $user->setEnabled(true);

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $formFactory->createForm();
        $form->setData($user);
        $form->get('username')->setData('tempUsername');
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $user->setUsername(explode('@',$form->get('email')->getData())[0]);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);
                $person = $this->getDoctrine()->getRepository('AppBundle:Person')->findOneBy(array('email'=>$user->getEmail()));
                if($person){
                    $person->setUserName($user->getUsername());
                    if($person->getTeacher()!= null){
                        $rolesArr = array('ROLE_TEACHER');
                        $teacherHasRole = new TeacherHasRole();
                        /** @var RoleType $roleType */
                        $roleType = $em->getRepository('AppBundle:RoleType')->findOneBy(array('roleCode'=>'ROLE_TEACHER'));
                        $teacherHasRole->setRoleTypeRoleType($roleType);
                        $roleType->addTeachersHasRole($teacherHasRole);
                        $teacherHasRole->setTeacherTeacher($person->getTeacher());
                        $person->getTeacher()->addTeacherHasRole($teacherHasRole);
                        $em->persist($teacherHasRole);
                        $em->persist($roleType);
                        $user->setRoles($rolesArr);
                        $userManager->updateUser($user);
                    }elseif($person->getStudent()!=null){
                        $rolesArr = array('ROLE_STUDENT');
                        $user->setRoles($rolesArr);
                        $userManager->updateUser($user);
                    }
                    $em->persist($person);
                    $em->flush();
                }
                $userManager->updateUser($user);
                $tUser = $em->getRepository('AppBundle:User')->findOneBy(array('email'=>$user->getEmail()));
                if($tUser and $person){
                    $tUser->setPersonPerson($person);
                    $em->persist($tUser);
                    $em->flush();
                }
                if (null === $response = $event->getResponse()) {
                    $url = $this->getParameter('fos_user.registration.confirmation.enabled')
                        ? $this->generateUrl('fos_user_registration_confirmed')
                        : $this->generateUrl('fos_user_profile_show');

                    $response = new RedirectResponse($url);
                }

                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                return $response;
            }

            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_FAILURE, $event);

            if (null !== $response = $event->getResponse()) {
                return $response;
            }
        }

        return $this->render('FOSUserBundle:Registration:register.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function confirmAction(Request $request, $token)
    {
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');

        $user = $userManager->findUserByConfirmationToken($token);

        if (null === $user) {
            throw new NotFoundHttpException(sprintf('The user with confirmation token "%s" does not exist', $token));
        }

        /** @var $dispatcher EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');


        $user->setConfirmationToken(null);
        $user->setEnabled(true);

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_CONFIRM, $event);

        $userManager->updateUser($user);

        if (null === $response = $event->getResponse()) {
            $url = $this->generateUrl('fos_user_registration_confirmed');
            $response = new RedirectResponse($url);
        }

        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_CONFIRMED, new FilterUserResponseEvent($user, $request, $response));

        return $response;
    }
}

<?php
// src/AppBundle/DataFixtures/ORM/LoadUserData.php

namespace RocketSeller\TwoPickBundle\DataFixtures\ORM;

use AppBundle\Entity\Person;
use AppBundle\Entity\Teacher;
use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;



class LoadUserData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * this function is mandatory in order to encode the user password other fixtures don't need it
     * @param ContainerInterface|null $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * function load
     * this fixture
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        //creating person for administrator user
        $person = new Person('Administrator');
        $manager->persist($person);
        //creating the teacher for the person administrator
        $teacher = new Teacher(null,'ADMINISTRATOR',new \DateTime());
        //adding the teacher role to the administrator person
        $person->addPersonRole($teacher);
        $manager->persist($teacher);
        $manager->flush();
        //creating user administrator
        $userAdmin = new User();
        $userAdmin->setUsername('Administrator');
        $userAdmin->setEnabled(1);
        //setting email and password
        $userAdmin->setEmail('arepasoftadm@gmail.com');
        $encoder = $this->container->get('security.password_encoder');
        $password = $encoder->encodePassword($userAdmin, 'admin');
        $userAdmin->setPassword($password);
        //adding the roles
        $rolesArr = array('ROLE_ADMIN');
        $userAdmin->setRoles($rolesArr);
        //linking the person with the user
        $userAdmin->setPersonPerson($person);
        $manager->persist($userAdmin);
        $manager->flush();
        //creating a direct reference for the user in the manager
        $this->addReference('admin-user', $userAdmin);
    }
    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 2;
    }
}

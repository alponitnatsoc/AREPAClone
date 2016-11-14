<?php

namespace AppBundle\Form;

use AppBundle\Entity\Course;
use AppBundle\Entity\Period;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewAssessmentTool extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $period = $options['period'];
        $course = $options['course'];
        $builder
            ->add('type',TextType::class,array(
                    'required'=>true,
                    'label'=>false,
            ))
            ->add('percentage',PercentType::class,array(
                'required'=>true,
            ))
            ->add('content',CollectionType::class,array(
                'entry_type'=> NewContent::class,
                'label'=>false,
                'allow_add'=>true,
                'allow_delete'=>true,
                'by_reference'=>false,
            ))
            ->add('contentPercentage',PercentType::class,array(
                'label'=>false,
                'disabled'=>true,
            ))
            ->add('outcomes',EntityType::class,array(
                'class'=>'AppBundle\Entity\Outcome',
                'query_builder'=>function (EntityRepository $er ) use ($period,$course){
                    return $er->createQueryBuilder('o')
                        ->join('o.courseContributesOutcome','co')
                        ->where('co.courseCourse = ?1')
                        ->andWhere('co.period = ?2')
                        ->setParameter('1',$course)
                        ->setParameter('2',$period);
                },
                'required'=>false,
                'multiple'=>true,
                'expanded'=>true,
            ));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'translation_domain'=>'FOSUserBundle',
            'course'=>new Course(),
            'period'=>new Period(),
        ));

    }

    public function getName()
    {
        return 'new_assessment_tool';
    }
}

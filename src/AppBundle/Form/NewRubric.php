<?php

namespace AppBundle\Form;

use AppBundle\Entity\Course;
use AppBundle\Entity\Period;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewRubric extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $period = $options['period'];
        $course = $options['course'];
        $builder
            ->add('name',TextType::class)
            ->add('assessmentPercentage',PercentType::class,array(
                'label'=>false,
                'disabled'=>true,
                'required'=>true,
            ))
            ->add('assessmentTool',CollectionType::class,array(
                'entry_type'=> NewAssessmentTool::class,
                'entry_options'=>array(
                    'period'=>$period,
                    'course'=>$course,
                ),
                'label'=>false,
                'allow_add'=>true,
                'allow_delete'=>true,
                'by_reference'=>false,
            ));


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'translation_domain'=>'FOSUserBundle',
            'period'=>new Period(),
            'course'=>new Course(),
        ));
    }

    public function getName()
    {
        return 'new_rubric';
    }
}

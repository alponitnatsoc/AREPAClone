<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Course;
use AppBundle\Entity\EvaluationModel;
use AppBundle\Entity\Period;
use AppBundle\Entity\Teacher;
use AppBundle\Form\Type\AssessmentToolType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvaluationModelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $period = $options['period'];
        $course = $options['course'];
        $teacher = $options['teacher'];
        $builder
            ->add('name',TextType::class,array(
                'label'=>'name',
                'required'=>true,
            ))
            ->add('owner',EntityType::class,array(
                'label'=>false,
                'class'=>'AppBundle\Entity\Teacher',
                'query_builder'=>function(EntityRepository $er)use($teacher){
                    return $er->createQueryBuilder('t')
                        ->where('t.idRole = ?1')
                        ->setParameter('1',$teacher->getIdRole());
                },
                'choice_label'=>'idRole',
                'required'=>true,
                'disabled'=>true,
                'attr'=>array(
                    'style'=>'display:none',
                )
            ))
            ->add('course',EntityType::class,array(
                'label'=>false,
                'class'=>'AppBundle\Entity\Course',
                'query_builder'=>function(EntityRepository $er)use($course){
                    return $er->createQueryBuilder('c')
                        ->where('c.idCourse = ?1')
                        ->setParameter('1',$course->getIdCourse());
                },
                'required'=>true,
                'disabled'=>true,
                'attr'=>array(
                    'style'=>'display:none',
                ),
                'choice_label'=>'idCourse',
            ))
            ->add('assessmentTools',CollectionType::class,array(
                'entry_type'=>AssessmentToolType::class,
                'entry_options'=>array(
                    'period'=>$period,
                    'course'=>$course,
                ),
                'required'=>true,
                'label'=>false,
                'allow_add'=>true,
                'allow_delete'=>true,
                'by_reference'=>false,
            ))
            ->add('assessmentPercentage',PercentType::class,array(
                'label'=>false,
                'disabled'=>false,
                'attr'=>array(
                    'style'=> 'width:40px;',
                ),
                'required'=>true,
            ))
            ->add('outcomeChecked',CheckboxType::class,array(
                'label'=>false,
                'attr'=>array(
                    'style'=> 'display:none;',
                ),
            ));


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'translation_domain'=>'FOSUserBundle',
            'period'=>'',
            'course'=>new Course(),
            'teacher'=>new Teacher(),
        ));
    }

    public function getName()
    {
        return 'new_evaluation_model';
    }
}

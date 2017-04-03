<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\AssessmentTool;
use AppBundle\Entity\Course;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class AssessmentToolType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $period = $options['period'];
        $course = $options['course'];
        $builder
            ->add('name',TextType::class,array(
                'required'=>true,
                'label'=>false,
                'constraints'=>array(
                    new NotBlank()
                ),
                'attr'=>array(
                    'placeholder'=>'content_name',
                ),
                'property_path'=>'name'
            ))
            ->add('description',TextType::class,array(
                'required'=>false,
                'label'=>false,
                'attr'=>array(
                    'placeholder'=>'content_description',
                ),
                'property_path'=>'description'
            ))
            ->add('content',CollectionType::class,array(
                'entry_type'=> AssessmentContentType::class,
                'entry_options'=>array(
                    'period'=>$period,
                    'course'=>$course,
                ),
                'label'=>false,
                'allow_add'=>true,
                'allow_delete'=>true,
                'by_reference'=>false,
            ))
            ->add('percentage',PercentType::class,array(
                'required'=>true,
                'label'=>false,
                'attr'=>array(
                    'style'=> 'width:40px;',
                ),
                "property_path"=>"percentage",
            ))
            ->add('contentPercentages',PercentType::class,array(
                'attr'=>array(
                    'style'=> 'width:40px;',
                ),
                'label'=>false,
                'disabled'=>false,
                'required'=>true,
            ))
            ->add('outcomes',EntityType::class,array(
                'class'=>'AppBundle\Entity\CourseContributesOutcome',
                'query_builder'=>function (EntityRepository $er ) use ($period,$course){
                    return $er->createQueryBuilder('cco')
                        ->where('cco.activePeriod = ?1')
                        ->andWhere('cco.course =?2')
                        ->setParameter('1',$period)
                        ->setParameter('2',$course);
                },
                "property_path"=>"courseContributeOutcomes",
                'label'=>false,
                'required'=>false,
                'multiple'=>true,
                'expanded'=>true,
            ));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'=>AssessmentTool::class,
            'translation_domain'=>'FOSUserBundle',
            'course'=>new Course(),
            'period'=>'',
        ));

    }

    public function getName()
    {
        return 'new_assessment_tool';
    }
}

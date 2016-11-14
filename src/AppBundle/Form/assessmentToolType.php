<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class assessmentToolType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,array(
                'required'=>true,
                'constraints'=>array(
                    new NotBlank()
                ),
                'attr'=>array(
                    "data-toggle"=>'tooltip',
                    "data-placement"=>"rigth",
                    "data-container"=>"body",
                ),
                'property_path'=>'name'
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
           'data_class'=>'AppBundle\Entity\AssessmentToolType'
        ));
    }

    public function getName()
    {
        return 'new_assessment_tool_type';
    }
}

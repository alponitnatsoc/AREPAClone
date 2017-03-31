<?php

namespace AppBundle\Form;

use AppBundle\Entity\Period;
use AppBundle\Form\Type\GenderType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewPeriodType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('period',TextType::class,array(
                'label'=>false,
                'required'=>true,
                'property_path'=>'code',
                'attr'=>array(
                    'placeholder'=>'addPeriod',
                ),
                'translation_domain' => 'FOSUserBundle'

            ))
            ->add('submit',SubmitType::class,array(
                'label'=>'add',
                'translation_domain' => 'FOSUserBundle',
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'=>Period::class,
        ));
    }

    public function getBlockPrefix()
    {
        return 'new_period_form';
    }
}

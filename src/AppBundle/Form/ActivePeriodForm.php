<?php

namespace AppBundle\Form;

use AppBundle\Form\Type\PeriodType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActivePeriodForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('activePeriod',PeriodType::class, array(
                'placeholder'=>'select_period',
                'label'=>false,
            ))
            ->add('submit',SubmitType::class,array(
                'label'=>'select',
            ));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'translation_domain'=>'FOSUserBundle',
        ));
    }

    public function getBlockPrefix()
    {
        return 'active_period_form';
    }
}

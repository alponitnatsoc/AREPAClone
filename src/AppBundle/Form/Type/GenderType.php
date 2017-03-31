<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GenderType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'choices' =>array(
                'M' => 'Male',
                'F' => 'Female',
            ),
            'label' => false,
            'translation_domain'=>'FOSUserBundle',
            'placeholder'=>'gender'
        ));
    }

    public function getParent()
    {
        return ChoiceType::class;
    }
}

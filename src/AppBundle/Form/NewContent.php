<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewContent extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,array(
                'label'=>false,
                'required'=>true,
            ))
            ->add('info',TextType::class,array(
                'label'=>false,
            ))
            ->add('percentageContent',PercentType::class,array(
                'label'=>false,
                'required'=>true,
            ))
            ->add('contributes',CheckboxType::class,array(
                'label'=>false,
                'required'=>false
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'translation_domain'=>'FOSUserBundle',
        ));

    }

    public function getName()
    {
        return 'new_content';
    }
}

<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class newPersonForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName',TextType::class,array(
                'constraints' => array(
                    new NotBlank(),
                ),
                'invalid_message'=>'Este campo es obligatorio',
                'label'=>'form.firstName',
                'property_path'=>'firstName',
                'attr'=>array(
                    'placeholder'=>'Ingresa tu primer nombre'
                )
            ))
            ->add('secondName',TextType::class,array(
                'required'=>false,
                'label'=>' Segundo nombre:',
                'property_path'=>'secondName',
                'attr'=>array(
                    'placeholder'=>'Ingresa tu segundo nombre'
                )
            ))
            ->add('lastName1',TextType::class,array(
                'required'=>true,
                'invalid_message'=>'Este campo es obligatorio',
                'label'=>'*Primer apellido:',
                'property_path'=>'lastName1',
                'attr'=>array(
                    'placeholder'=>'Ingresa tu primer apellido'
                )
            ))
            ->add('lastName2',TextType::class,array(
                'required'=>false,
                'invalid_message'=>'Este campo es obligatorio',
                'label'=>' Segundo apellido:',
                'property_path'=>'lastName2',
                'attr'=>array(
                    'placeholder'=>'Ingresa tu segundo apellido'
                )
            ))
            ->add('documentType',ChoiceType::class,array(
                'choices'  => array(
                    'Cedula de ciudadania' => 'CC',
                    'Tarjeta de identidad' => 'TI',
                    'Cedula de extranjeria' => 'CE',
                    'Pasaporte' => 'PS',
                ),
                'required'=>true,
                'invalid_message'=>'Por favor selecciona una opcion',
                'label'=>'*Tipo de documento:',
                'placeholder'=>'Selecciona un tipo',
                'property_path'=>'documentType'
            ))
            ->add('document',TextType::class,array(
                'required'=>true,
                'invalid_message'=>'Este campo es obligatorio',
                'label'=>'*Numero de documento:',
                'property_path'=>'document',
                'attr'=>array(
                    'placeholder'=>'Ingresa tu numero de documento'
                )
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'=>'AppBundle\Entity\Person'
        ));
    }

    public function getName()
    {
        return 'new_person_form';
    }
}

<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotBlankValidator;

class addDocument extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type',TextType::class,array(
                'label'=>false,
                'attr'=>array(
                    'style'=>'display:none',
                ),
                'required'=>true,
            ))
            ->add('document', FileType::class, array(
                    'label_attr' => array(
                        'style' => 'display:none',
                    ),
                    'by_reference' => false,
                    'required' => true,
                    'multiple' => false,
                    'attr' => array(
                        'accept' =>'application/vnd.ms-excel,application/msexcel,application/x-msexcel,application/x-ms-excel,application/x-excel,application/x-dos_ms_excel,application/xls,application/x-xls,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    ),
                    'constraints' => array(
                        new NotBlank(array(
                            'message'=>'Por favor selecciona un archivo'
                        ))
                    ),
                )
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getName()
    {
        return 'add_document_form';
    }
}

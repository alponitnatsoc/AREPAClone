<?php

namespace AppBundle\Form\Type;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PeriodType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'class'=>'AppBundle\Entity\Period',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('p')
                    ->orderBy('p.code', 'DESC');
            },
            'translation_domain'=>'FOSUserBundle',
            'required'=>true,
            'expanded'=>false,
            'multiple'=>false,
        ));
    }

    public function getParent()
    {
        return EntityType::class;
    }
}

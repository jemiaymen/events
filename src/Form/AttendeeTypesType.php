<?php

namespace App\Form;

use App\Entity\AttendeeTypes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AttendeeTypesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name')
            ->add('Price')
            ->add('AttendeeLimit')
            ->add('MinWorkshops')
            ->add('MaxWorkshops')
            ->add('Description')
            ->add('AllowEdit')
            ->add('AllowPublicRegistration')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AttendeeTypes::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Attendees;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AttendeesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('FirstName')
            ->add('LastName')
            ->add('Email')
            ->add('Company')
            ->add('Tel')
            ->add('Country')
            ->add('Job')
            ->add('Photo')
            ->add('CheckedIn')
            ->add('Type')
            ->add('Event')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Attendees::class,
        ]);
    }
}

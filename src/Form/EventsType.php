<?php

namespace App\Form;

use App\Entity\Events;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class EventsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name')
            ->add('StartDate',DateTimeType::class,[
                'widget' => 'single_text'
            ])
            ->add('EndDate',DateTimeType::class,[
                'widget' => 'single_text'
            ])
            ->add('Location')
            ->add('Logo',FileType::class,[
                'data_class'=> null, 
                'label' => 'Logo',
                'required' => false
            ])
            ->add('Banner',FileType::class,[
                'data_class'=> null, 
                'label' => 'Banner',
                'required' => false
            ])
            ->add('Description',TextareaType::class)
            ->add('Budget')
            ->add('OwnerName')
            ->add('OwnerMail')
            ->add('Active')
            ->add('Currency',ChoiceType::class,[
                'choices'  => [
                    'TND' => 'TND',
                    'US Dollar' => '$',
                    'Euro' => '€'
                ]
            ])
            ->add('Language', ChoiceType::class, [
                'choices'  => [
                    'English' => 'English',
                    'Français' => 'Francais',
                    'Arabe' => 'Arabe'
                ]
            ])
            ->add('Country', ChoiceType::class, [
                'choices'  => [
                    'Tunisia' => 'Tunisia',
                    'France' => 'France',
                    'USA' => 'USA'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Events::class,
        ]);
    }
}

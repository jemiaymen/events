<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RoleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class ,['disabled' => true])
            ->add('FirstLastName',TextType::class ,['disabled' => true])
            ->add('roles', ChoiceType::class, [
                'choices'  => [
                    'Admin' => 'ROLE_ADMIN',
                    'Participant' => 'ROLE_P',
                    'Invité' => 'ROLE_I',
                    'Modérateur' => 'ROLE_M',
                    'Organisateur' => 'ROLE_O',
                    'Sponsor' => 'ROLE_S',
                    'Exposant' => 'ROLE_E',
                    'Prestataires de service' => 'ROLE_PES'
                ],
                'multiple' => true,

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

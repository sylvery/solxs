<?php

namespace App\Form;

use App\Entity\Appuser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AppuserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'row_attr' => ['class' => 'col-md-12 input-group mb-2'],
                'label_attr' => ['class' => 'col-md-6 text-muted small input-group-prepend'],
                'attr' => ['class' => 'form-control'],
            ])
            // ->add('roles')
            ->add('password', PasswordType::class, [
                'row_attr' => ['class' => 'col-md-12 input-group mb-2'],
                'label_attr' => ['class' => 'col-md-6 text-muted small input-group-prepend'],
                'attr' => ['class' => 'form-control password input-password'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Appuser::class,
        ]);
    }
}

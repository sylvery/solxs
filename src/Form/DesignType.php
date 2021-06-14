<?php

namespace App\Form;

use App\Entity\Design;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DesignType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'row_attr' => ['class' => 'col-md-12 input-group mb-2'],
                'label_attr' => ['class' => 'col-3 text-muted input-group-prepend'],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('description', null, [
                'row_attr' => ['class' => 'col-md-12 input-group mb-2'],
                'label_attr' => ['class' => 'col-3 text-muted input-group-prepend'],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('category', null, [
                'row_attr' => ['class' => 'col-md-12 input-group mb-2'],
                'label_attr' => ['class' => 'col-3 text-muted input-group-prepend'],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('imageFile', FileType::class, [
                'row_attr' => ['class' => 'col-md-12 input-group mb-2'],
                'label_attr' => ['class' => 'col-3 text-muted input-group-prepend'],
                // 'attr' => ['class' => 'col'],
            ])
            // ->add('customerOrders')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Design::class,
        ]);
    }
}

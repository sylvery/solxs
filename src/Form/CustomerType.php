<?php

namespace App\Form;

use App\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fullName', TextType::class, [
                'row_attr' => ['class' => 'col-md-12 input-group mb-2'],
                'label_attr' => ['class' => 'col-md-6 text-muted small input-group-prepend'],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('phoneNumber', TextType::class, [
                'row_attr' => ['class' => 'col-md-12 input-group mb-2'],
                'label_attr' => ['class' => 'col-md-6 text-muted small input-group-prepend'],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('location', TextType::class, [
                'row_attr' => ['class' => 'col-md-12 input-group mb-2'],
                'label_attr' => ['class' => 'col-md-6 text-muted small input-group-prepend'],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('customerOrders', CollectionType::class, [
                'entry_type' => CustomerNewOrderType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'row_attr' => ['class' => 'col-md-12 input-group mb-2'],
                'label_attr' => ['class' => 'col-md-6 text-muted small input-group-prepend'],
                'attr' => ['class' => 'form-control'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Customer::class,
        ]);
    }
}

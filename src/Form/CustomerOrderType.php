<?php

namespace App\Form;

use App\Entity\CustomerOrder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerOrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('customer', null, [
                'row_attr' => ['class' => 'col-12 input-group mb-2'],
                'label_attr' => ['class' => 'col-4 text-muted input-group-prepend'],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('designs', null, [
                'row_attr' => ['class' => 'col-12 input-group mb-2'],
                'label_attr' => ['class' => 'col-4 text-muted input-group-prepend'],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('description', null, [
                'row_attr' => ['class' => 'col-12 input-group mb-2'],
                'label_attr' => ['class' => 'col-4 text-muted input-group-prepend'],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('deliveryLocation', null, [
                'row_attr' => ['class' => 'col-12 input-group mb-2'],
                'label_attr' => ['class' => 'col-4 text-muted input-group-prepend'],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('dateordered', null, [
                'row_attr' => ['class' => 'col-12 input-group mb-2'],
                'label_attr' => ['class' => 'col-4 text-muted input-group-prepend'],
                'attr' => ['class' => 'form-control'],
                'input' => 'string',
                'label' => 'Date Ordered',
                'widget' => 'single_text',
            ])
            ->add('designed', null, [
                'row_attr' => ['class' => 'col-12 input-group form-inline mb-2'],
                'label_attr' => ['class' => 'col-8 text-muted input-group-append'],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('printed', null, [
                'row_attr' => ['class' => 'col-12 input-group form-inline mb-2'],
                'label_attr' => ['class' => 'col-8 text-muted input-group-append'],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('paid', null, [
                'row_attr' => ['class' => 'col-12 input-group form-inline mb-2'],
                'label_attr' => ['class' => 'col-8 text-muted input-group-append'],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('delivered', null, [
                'row_attr' => ['class' => 'col-12 input-group form-inline mb-2'],
                'label_attr' => ['class' => 'col-8 text-muted input-group-append'],
                'attr' => ['class' => 'form-control'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CustomerOrder::class,
        ]);
    }
}

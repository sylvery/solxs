<?php

namespace App\Form;

use App\Entity\CustomerOrder;
use App\Entity\Design;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Workflow\Registry;

class CustomerOrderType extends AbstractType
{
    private $wfr;
    public function __construct(Registry $registry)
    {
        $this->wfr = $registry;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $formEvent) {
            $form = $formEvent->getForm();
            $data = $formEvent->getData();
            $workflow = $this->wfr->get($data, 'orders');
            if ($workflow->can($data, 'to_order')) {
                $form
                    ->add('customer', null, [
                        'required' => 'required',
                        'row_attr' => ['class' => 'col-12 input-group mb-2'],
                        'label_attr' => ['class' => 'col-4 text-muted input-group-prepend'],
                        'attr' => ['class' => 'form-control'],
                    ])
                    ->add('designs', null, [
                        'expanded' => true,
                        'multiple' => true,
                        // 'class' => Design::class,
                        // 'choices' => $group->getDesigns(),
                        'row_attr' => ['class' => 'row'],
                        'label_attr' => ['class' => 'col-4 text-muted'],
                        'attr' => ['class' => 'col'],
                    ])
                    ->add('color', ChoiceType::class, [
                        'choices' => [
                            'White' => 'white',
                            'Black' => 'black',
                            'Medium blue' => 'medium blue',
                            'Navy' => 'navy',
                            'Red' => 'red',
                            'Maroon' => 'maroon',
                        ],
                        'row_attr' => ['class' => 'col-12 input-group my-2'],
                        'label_attr' => ['class' => 'col-4 text-muted input-group-prepend'],
                        'attr' => ['class' => 'form-control', 'type' => 'color'],
                    ])
                    ->add('orientation', ChoiceType::class, [
                        'choices' => [
                            'Front' => 'front',
                            'Back' => 'back',
                        ],
                        'row_attr' => ['class' => 'col-12 input-group mb-2'],
                        'label_attr' => ['class' => 'col-4 text-muted input-group-prepend'],
                        'attr' => ['class' => 'form-control'],
                    ])
                    ->add('itemsize', ChoiceType::class, [
                        'choices' => [
                            'Kids' => 'kids',
                            'Small' => 'small',
                            'Medium' => 'medium',
                            'Large' => 'large',
                            'Extra Large' => 'xl',
                            '2x Extra Large' => 'xxl',
                            '3x Extra Large' => '3xl',
                        ],
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
                ;
            } else if($workflow->can($data, 'to_design')){
                $form->add('designed', null, [
                    'row_attr' => ['class' => 'col-12 input-group form-inline mb-2'],
                    'label_attr' => ['class' => 'col-8 text-muted input-group-append'],
                    'attr' => ['class' => 'form-control'],
                ]);
            } else if($workflow->can($data, 'to_print')){
                $form                
                    ->add('printed', null, [
                        'row_attr' => ['class' => 'col-12 input-group form-inline mb-2'],
                        'label_attr' => ['class' => 'col-8 text-muted input-group-append'],
                        'attr' => ['class' => 'form-control'],
                    ])
                    ;
                } else if($workflow->can($data, 'to_deliver')){
                    $form
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
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CustomerOrder::class,
        ]);
    }
}

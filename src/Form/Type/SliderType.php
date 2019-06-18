<?php

namespace SliderBundle\Form\Type;

use SliderBundle\Entity\Slider;
use Oro\Bundle\OrganizationBundle\Form\Type\OrganizationSelectType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SliderType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'organization',
                OrganizationSelectType::class,
                [
                    'required' => true,
                ]
            )
            ->add(
                'code',
                TextType::class,
                [
                    'required' => true,
                ]
            )
            ->add(
                'name',
                TextType::class,
                [
                    'required' => true,
                ]
            )
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'allow_extra_fields' => true,
                'data_class' => Slider::class,
            ]
        );
    }
}

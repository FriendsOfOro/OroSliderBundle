<?php

namespace SliderBundle\Form\Type;

use Doctrine\Common\Persistence\ObjectRepository;
use Oro\Bundle\FormBundle\Form\Type\OroEntitySelectOrCreateInlineType;
use SliderBundle\Form\DataTransformer\SliderModelTransformer;
use SliderBundle\Form\DataTransformer\SliderViewTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SliderSelectType extends AbstractType
{
    const NAME = 'kiboko_slider_select';

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'autocomplete_alias' => 'kiboko_slider',
                'create_form_route' => 'kiboko_slider_create',
                'grid_name' => 'kiboko-slider-grid',
                'configs' => [
                    'placeholder' => 'kiboko.slider.form.choose',
                ]
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return OroEntitySelectOrCreateInlineType::class;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return self::NAME;
    }
}

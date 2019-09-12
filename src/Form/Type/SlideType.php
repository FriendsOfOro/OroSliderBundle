<?php

namespace SliderBundle\Form\Type;

use Oro\Bundle\AttachmentBundle\Form\Type\FileType;
use Oro\Bundle\FormBundle\Form\Type\OroDateTimeType;
use Oro\Bundle\FormBundle\Form\Type\OroRichTextType;
use Oro\Bundle\ScopeBundle\Form\Type\ScopeCollectionType;
use SliderBundle\Entity\Slide;
use Oro\Bundle\OrganizationBundle\Form\Type\OrganizationSelectType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SlideType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'enabled',
                CheckboxType::class,
                [
                    'required' => true,
                    'label' => 'oro.user.enabled.label'
                ]
            )
            ->add(
                'organization',
                OrganizationSelectType::class,
                [
                    'required' => true,
                ]
            )
            ->add(
                'slider',
                SliderSelectType::class,
                [
                    'required' => true,
                ]
            )
            ->add(
                'sort_order',
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
            ->add(
                'picture',
                FileType::class,
                [
                    'required' => true,
                    'allowDelete' => true,
                ]
            )
            ->add(
                'description',
                OroRichTextType::class,
                [
                    'required' => true,
                ]
            )
            ->add(
                'url',
                TextType::class,
                [
                    'required' => true,
                ]
            )
            ->add(
                'button',
                TextType::class,
                [
                    'required' => true,
                ]
            )
            ->add(
                'startedAt',
                OroDateTimeType::class,
                [
                    'required' => true,
                ]
            )
            ->add(
                'expiredAt',
                OroDateTimeType::class,
                [
                    'required' => true,
                ]
            )
            ->add(
                'scopes',
                ScopeCollectionType::class,
                [
                    'label' => 'oro.cms.contentblock.scopes.label',
                    'entry_options' => [
                        'scope_type' => 'slider'
                    ],
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
                'data_class' => Slide::class,
            ]
        );
    }
}

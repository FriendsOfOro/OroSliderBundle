<?php


namespace SliderBundle;


use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class SettingsFormConfigurator
{
    public static function buildForm(FormBuilderInterface $builder, array $options)
    {
       $builder
           ->add('test',TextType::class);
    }
}
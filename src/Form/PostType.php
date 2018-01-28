<?php
/**
 * Created by PhpStorm.
 * User: MY
 * Date: 28.01.2018
 * Time: 18:30
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dataPost', DateType::class)
            ->add('heading', TextType::class)
            ->add('textPost', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Task'))
            ->getForm();
        ;
    }
}
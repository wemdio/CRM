<?php

namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProjectFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('userPosition', TextType::class, [
                'label' => 'Должность',
                'required' => true
            ])
            ->add('name', TextType::class, [
                'label' => 'Название проекта',
                'required' => true
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Описание',
                'required' => true
            ])
            ->add('status', TextType::class, [
                'label' => 'Статус',
                'required' => true
            ])
            ->add('hypothesis', TextareaType::class, [
                'label' => 'Гипотеза', 
                'required' => false
            ])
            ->add('company', TextType::class, [
                'label' => 'Компания', 
                'required' => false
            ])
            ->add('brief', TextareaType::class, [
                'label' => 'Бриф', 
                'required' => false
            ])
            ->add('offer', TextareaType::class, [
                'label' => 'Оффер', 
                'required' => false
            ])
            ->add('site', TextType::class, [
                'label' => 'Сайт', 
                'required' => false
            ])
            ->add('information', TextareaType::class, [
                'label' => 'Информация', 
                'required' => false
            ])
            ->add('turnover', TextType::class, [
                'label' => 'Оборот', 
                'required' => false
            ])
            ->add('direction', TextType::class, [
                'label' => 'Направление', 
                'required' => false
            ])
            ->add('kpi', TextareaType::class, [
                'label' => 'KPI', 
                'required' => false
            ])
            ->add('history', TextareaType::class, [
                'label' => 'История', 
                'required' => false
            ])
            ->add('payment', TextType::class, [
                'label' => 'Оплата', 
                'required' => false
            ])
            ->add('amount', TextType::class, [
                'label' => 'Сумма', 
                'required' => false
            ])
            ->add('format', TextType::class, [
                'label' => 'Формат', 
                'required' => false
            ])
            ->add('expenses', TextType::class, [
                'label' => 'Расходы', 
                'required' => false
            ])
            ->add('contract', TextType::class, [
                'label' => 'Договор', 
                'required' => false
            ])
            ->add('launch', TextType::class, [
                'label' => 'Запуск', 
                'required' => false
            ])
            ->add('deadline', TextType::class, [
                'label' => 'Дедлайн', 
                'required' => false
            ])
            ->add('specialist', TextType::class, [
                'label' => 'Специалист', 
                'required' => false
            ])
            ->add('mentor', TextType::class, [
                'label' => 'Ментор', 
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
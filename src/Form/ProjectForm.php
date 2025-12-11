<?php 

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ProjectForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user_position')
            ->add('ststus')
            ->add('name')
            ->add('description')
            ->add('hypothesis')
            ->add('company')
            ->add('brief')
            ->add('offer')
            ->add('site')
            ->add('information')
            ->add('turnover')
            ->add('direction')
            ->add('kpi')
            ->add('history')
            ->add('payment')
            ->add('amount')
            ->add('format')
            ->add('expenses')
            ->add('contract')
            ->add('launch')
            ->add('deadline')
            ->add('specialist')
            ->add('mentor');
            
    }
}
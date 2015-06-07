<?php

namespace Atw\TestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ;
        $builder
            ->add('username')
            ->add('enabled', 'checkbox', [
                'required' => false,
            ])
            ->add('password')
            ->add('roles', 'collection', [
                'allow_add' => true,
                'allow_delete' => true,
                'delete_empty' => true,
                'prototype' => true,
                'type' => 'choice',
                'options' => ['choices' => [
				    'ROLE_ENGINEER' => 'ROLE_ENGINEER',
				    'ROLE_ANA' => 'ROLE_ANA',
				    'ROLE_BS'  => 'ROLE_BS',
				], 'required' => false],
                'attr' => ['class' => 'collection'],
            ])
            ->add('corpname')
            ->add('zip');
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Atw\TestBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'atw_testbundle_user';
    }
}

<?php

namespace Atw\TestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Atw\TestBundle\Form\Support\FormatDatetimeTransformer;

class CategoryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categoryCode')
            ->add('name')
            ->add(
                $builder->create('expiredAt', 'text', [
                    'attr'     => ['class' => 'hoge'],
                    'required' => false,
                ])->addViewTransformer(new FormatDatetimeTransformer())
        );

        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Atw\TestBundle\Entity\Category'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'atw_testbundle_category';
    }
}

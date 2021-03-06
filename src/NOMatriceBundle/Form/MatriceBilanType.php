<?php

namespace NOMatriceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MatriceBilanType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('force','textarea',array('required'=>false,))
        ->add('weakness','textarea',array('required'=>false,))
        ->add('opportunity','textarea',array('required'=>false,))
        ->add('threat','textarea',array('required'=>false,));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'NOMatriceBundle\Entity\MatriceBilan'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'nomatricebundle_matricebilan';
    }


}

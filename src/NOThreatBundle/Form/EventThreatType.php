<?php

namespace NOThreatBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventThreatType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('definition','textarea')
        ->add('causes','textarea')
        ->add('consequences','textarea')
        ->add('costThreat','textarea')
        ->add('actions','textarea')
        ->add('pilotage','textarea')
        ->add('threatSubFamily','entity',array(
                    'class'    => 'NOThreatBundle:ThreatSubFamily',
                    'property' => 'name',
                    'multiple' => false ,));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'NOThreatBundle\Entity\EventThreat'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'nothreatbundle_eventthreat';
    }


}

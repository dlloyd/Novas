<?php

namespace NODiagBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use NODiagBundle\Form\AnswerType;

class QuestionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('question', 'textarea' )
                ->add('subFamily','entity', array(
                    'class'    => 'NODiagBundle:QuestionSubFamily',
                    'property' => 'name',
                    'multiple' => false ,))
                ->add('answers', 'collection' ,array(
                    'type' => new AnswerType(),
                    'allow_add' => true,
                    'allow_delete' => true,));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'NODiagBundle\Entity\Question'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'nodiagbundle_question';
    }


}

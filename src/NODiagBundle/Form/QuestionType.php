<?php

namespace NODiagBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use NODiagBundle\Form\AnswerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class QuestionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('innerId','text')
                ->add('question', 'textarea' )
                ->add('pdfFile','file',array('required' => false,))
                ->add('imageFile','file',array('required' => false,))
                ->add('videoYoutubeLink','text')
                ->add('subFamily',EntityType::class, array(
                    'class'    => 'NODiagBundle:QuestionSubFamily',
                    'choice_label' => function ($subFamily) {
                            return $subFamily->getName();
                        },
                    'group_by' => function($subFamily) {
                                        return $subFamily->getFamily()->getName();
                                    },
                    'multiple' => false ,))
                ->add('answerTypeIsMultiple',CheckboxType::class, array(
                        'label'    => 'Question à choix multiple?',
                        'required' => false,
                    ));
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

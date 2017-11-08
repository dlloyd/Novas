<?php

namespace NOMatriceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use NOMatriceBundle\Form\PoliticalMatriceType;
use NOMatriceBundle\Form\EconomicalMatriceType;

class MatriceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('politicalMatrice', new PoliticalMatriceType())
                ->add('economicalMatrice', new EconomicalMatriceType())
                ->add('socioCulturalMatrice', new SocioCulturalMatriceType())
                ->add('technologicalMatrice', new TechnologicalMatriceType())
                ->add('legalMatrice', new LegalMatriceType());
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'NOMatriceBundle\Entity\Matrice'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'nomatricebundle_matrice';
    }


}

<?php

namespace CompanyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use NOMatriceBundle\Form\MatriceType;
use CompanyBundle\Form\AddressType;

class CompanyType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('innerId','text')
        ->add('denomination', 'text')
        ->add('employeesNumber','number')
        ->add('activityBeginDate','text')
        ->add('socialCapital','text')
        ->add('activityBranch','entity',array(
                    'class'    => 'CompanyBundle:activityBranch',
                    'property' => 'name',
                    'multiple' => false ,))
        ->add('address', new AddressType())
        ->add('legalStatus','entity',array(
                    'class'    => 'CompanyBundle:LegalStatus',
                    'property' => 'name',
                    'multiple' => false ,))
        ->add('codeNAF','entity',array(
                    'class'    => 'CompanyBundle:CodeNAF',
                    'property' => 'name',
                    'multiple' => false ,));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CompanyBundle\Entity\Company'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'companybundle_company';
    }


}

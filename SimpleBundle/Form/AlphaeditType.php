<?php

namespace Jus\SimpleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Jus\SimpleBundle\Form\DataTransformer;
use Jus\SimpleBundle\Form\DataTransformer\AlphaToIdTransformer;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AlphaeditType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder ->add('title', TextType::class)
		 ->add('betas', CollectionType::class, array(
                    'entry_type' => BetaType::class,
		    'allow_add'      => true,
                    'allow_delete'  => true,
		    'by_reference' => false,
                    'label' => '',
                    'label_attr' => array('class' => 'second-level-top'),
		    'prototype' => true,
                    'prototype_name' => '__beta_prot__'
                 ))
		->add('Save', SubmitType::class, array('attr' => array('class' => 'save'))) 
		;

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Jus\SimpleBundle\Entity\Alpha'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'jus_simplebundle_alpha';
    }


}

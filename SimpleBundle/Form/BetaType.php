<?php

namespace Jus\SimpleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class BetaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', TextType::class, array('label' => 'Titolo'))
	 	 ->add('gammas', CollectionType::class, array(
                    'entry_type' => GammaType::class,
		    'allow_add'      => true,
                    'allow_delete'  => true,
		    'by_reference' => false,
                    'label' => '',
		    'label_attr' => array('class' => 'third-level-top'),
		    'prototype' => true,
                    'prototype_name' => '__gamma_prot__'
                ))   
	  ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Jus\SimpleBundle\Entity\Beta'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'jus_simplebundle_beta';
    }
}

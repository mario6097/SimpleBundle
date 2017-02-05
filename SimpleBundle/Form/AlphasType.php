<?php

namespace Jus\SimpleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AlphasType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('alphas', CollectionType::class, array(
                    'entry_type'=> AlphaType::class, 
                    'allow_add'      => true,
                    'allow_delete'  => true,
		    'by_reference' => false,
                    'label' => 'Insert one more alpha',
                    'prototype' => true,
                    'prototype_name' => '__alpha_prot__'
               ))
            //  ->add('Save', SubmitType::class, array('attr' => array('class' => 'save')))       
			;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
       $resolver->setDefaults(array(
            'data_class' => null
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'jus_simplebundle_alphas';
    }


}

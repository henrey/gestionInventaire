<?php

namespace OPT\EquipementsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class IdentificationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('model',  TextType::class,array('label'=>'Model'))
            ->add('type',  TextType::class,array('label'=>'Type'))
            ->add('serie',  TextType::class,array('label'=>'Série'))
            ->add('numeroImmo',  TextType::class,array('label'=>'Numéro Immo'))
            ->add('nomLogique',  TextType::class,array('label'=>'Nom logique'))
            ->add('dateFinGarantie', DateType::class,array('placeholder'=>''))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OPT\EquipementsBundle\Entity\Identification'
        ));
    }
}

<?php

namespace OPT\EquipementsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ContratType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomContrat',  TextType::class,array('label'=>'Nom du contrat'))
            ->add('dateFinContrat', DateType::class,array('label'=>'Date de fin de contrat '))
            ->add('save',  SubmitType::class,array('label'=>'Enregistrer'))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OPT\EquipementsBundle\Entity\Contrat'
        ));
    }
}

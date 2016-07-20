<?php

namespace OPT\EquipementsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use OPT\EquipementsBundle\Form\IdentificationType;
use Doctrine\ORM\Mapping as ORM;
class EquipementType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     * @ORM\HasLifecyclecallback()
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type')
            ->add('commentaire')
            ->add('uDepart')
            ->add('nbU')
            ->add('nomLogique')
            ->add('installation', 'date')
            ->add('qui')
            ->add('dateDebutContrat', 'date')
            ->add('dateCreation', 'date')
            ->add('dateModification', 'date')
            ->add('idContenant')
            ->add('actif')
            ->add('salle')
            ->add('constructeur')
            ->add('contrat')
            ->add('identification', new IdentificationType())
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OPT\EquipementsBundle\Entity\Equipement'
        ));
    }
}

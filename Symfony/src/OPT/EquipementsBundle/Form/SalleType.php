<?php

namespace OPT\EquipementsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Doctrine\ORM\EntityManager;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SalleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /*$controller=new \OPT\EquipementsBundle\Controller();
        
        ///// Récupérer le service EntotyManager///////
        
        $repository=  $this->get('repository');
        
        $repository=$em->getRepository('OPTEquipementsBundle:Site');
        
        $listeSites=$repository->findAll();
        
        $builder
            ->add('nomSalle')
            ->add('site',  ChoiceType::class,[
                ['choices'=>$listeSites],
                'choice_label'=>'NomSite',
                'group_by'=>function(){return null;},
                'choice_value'=>'id'
            ])
            ->add('save',  SubmitType::class,array('label'=>'Enregistrer'))
        ;
         
         */
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OPT\EquipementsBundle\Entity\Salle'
        ));
    }
}

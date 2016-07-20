<?php

namespace OPT\EquipementsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use OPT\EquipementsBundle\Entity\Salle;
use OPT\EquipementsBundle\Form\SalleType;
use OPT\EquipementsBundle\Entity\Equipement;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;



class SallesController extends Controller
{
    public function AddAction(Request $request)
    {
        $salle=new Salle();
        
        $em=  $this->getDoctrine()
                ->getManager();
        $repo=$em->getRepository('OPTEquipementsBundle:Site');       
        $listeSites=$repo->findAll();       
        
        $form=$this->createFormBuilder($salle,array('required'=>false))
                ->add('nomSalle', TextType::class,array('label'=>'Nom de la salle'))
                ->add('site', ChoiceType::class ,['choices'=>  // le champ si de la salle est renseigné par une valeur prise dans une liste  réroulante
                    [$listeSites],                             // choices => listeSites sont les éléments de la liste
                    'choice_label' => 'NomSite',               // choice_label les champs à afficher
                    'group_by' => function(){ return null;},   // group_by regroupement
                    'choice_value' => 'id'                     // choice_value: la valeur sélectionné dans la liste
                    
                ])                        
                ->add('save', SubmitType::class,array('label'=>'Enregistrer'))
                ->getForm();       
        $form->handleRequest($request);               
        if($form->isValid())
        {
            $em->persist($salle);
            $em->flush();
            $this->addFlash('notice', "Salle "." enregistré!"); 
            return $this->redirectToRoute('liste_salles');
        }            
        return $this->render('OPTEquipementsBundle:salles:addSalle.html.twig',
                array('form'=>$form->createView()));
    }
    
    public function ListerAction()
    {
        $listeSalle=new Salle();
        $repository=  $this->getDoctrine()->getRepository('OPTEquipementsBundle:Salle');        
        $listeSalle=$repository->findAll();
        return $this->render('OPTEquipementsBundle:salles:listeSalles.html.twig',['listeSalles'=>$listeSalle]);
        
    }
    
    /**
     * @Route("/supprimerSalle/{id}") 
     * @param type $id
     * @return type
     */
    public function SupprimerAction($id)
    {
        $salle=new Salle();
        $em=  $this->getDoctrine()
                ->getEntityManager();
        $repo=  $this->getDoctrine()
                ->getRepository('OPTEquipementsBundle:Salle');
        $salle=$repo->find($id);
        $nomSalle=$salle->getNomSalle();
        
        $em->remove($salle);
        $em->flush();
        
        $this->addFlash('notice', "Salle ".$nomSalle." supprimé!");
        
        return $this->redirectToRoute('liste_salles');
        
    }
}
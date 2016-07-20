<?php

namespace OPT\EquipementsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use OPT\EquipementsBundle\Entity\Constructeur;
use OPT\EquipementsBundle\Form\ConstructeurType;
use Symfony\Component\HttpFoundation\Request;

class ConstructeursController extends Controller
{
    public function AddAction(Request $request)
    {
        $constructeur=new Constructeur();
        
        $form=$this->createForm(ConstructeurType::class,$constructeur);
        
        $form->handleRequest($request);
        
        if($form->isValid())
        {
            $em=  $this->getDoctrine()
                    ->getManager();
            $em->persist($constructeur);
            $em->flush();
            echo 'Le constructeur: '.$constructeur->getNomConstructeur().' a bien été enregistré.';
            return $this->redirectToRoute('detail_constructeur',['id'=>$constructeur->getId()]);
        }
        
        return $this->render('OPTEquipementsBundle:constructeurs:addConstructeur.html.twig',
                array('form'=>$form->createView()));        
    }
    
    public function ListerAction()
    {
        $listeConstructeurs= new Constructeur();
        
        $repository=  $this->getDoctrine()->getRepository('OPTEquipementsBundle:Constructeur');
        $listeConstructeurs=$repository->findAll();
        return $this->render('OPTEquipementsBundle:constructeurs:listeConstructeurs.html.twig',['listeConstructeurs'=>$listeConstructeurs]);
    }
    
    public function DetailAction($id)
    {
        $constructeur=new Constructeur();
        
        $repo=  $this->getDoctrine()->getRepository('OPTEquipementsBundle:constructeur');
        
        $constructeur=$repo->find($id);
        return $this->render('OPTEquipementsBundle:constructeurs:detailConstructeur.html.twig',['constructeur'=>$constructeur]);
    }
    
}
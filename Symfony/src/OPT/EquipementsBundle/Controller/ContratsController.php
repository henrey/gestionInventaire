<?php

namespace OPT\EquipementsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use OPT\EquipementsBundle\Entity\Contrat;
use OPT\EquipementsBundle\Form\ContratType;
use Symfony\Component\HttpFoundation\Request;
class ContratsController extends Controller
{
    public function addAction(Request $request)
    {
        $contrat=new Contrat();
        
        $form=$this->createForm(ContratType::class,$contrat);
        $form->handleRequest($request);
        
        if($form->isValid())
        {
            $em=  $this->getDoctrine()
                    ->getManager();
            $em->persist($contrat);
            $em->flush();
            echo 'Le contrat: '.$contrat->getNomContrat().' a bien été enregistré!';
        }
        
        return $this->render('OPTEquipementsBundle:contrats:addContrat.html.twig',
                array('form'=>  $form->createView()));
        
    }
    public function ListerAction()
    {
        $listeContrats=new Contrat();
        $repository=  $this->getDoctrine()->getRepository('OPTEquipementsBundle:Contrat');
        $listeContrats=$repository->findAll();
        
        return $this->render('OPTEquipementsBundle:contrats:listeContrats.html.twig',['listeContrats'=>$listeContrats]);
        
    }
}
<?php

namespace OPT\EquipementsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use OPT\EquipementsBundle\Entity\Equipement;

class DefaultController extends Controller
{
    
    public function indexAction()
    {
        $repository=  $this->getDoctrine()->getManager()->getRepository('OPTEquipementsBundle:Equipement');
        $listeEquipements=$repository->findBy(array('actif'=>true),array('dateModification'=>'DESC'));   
        $nombreResultats=count($listeEquipements);
        return $this->render('OPTEquipementsBundle:equipements:listeEquipements.html.twig',
        ["listeEquipements"=>$listeEquipements,'nombreResultats'=>$nombreResultats]);
    }
     
     
    
}

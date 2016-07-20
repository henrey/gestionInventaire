<?php

namespace OPT\EquipementsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use OPT\EquipementsBundle\Entity\Site;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;
use OPT\EquipementsBundle\Form\SiteType;

class SitesController extends Controller
{
    public function AddAction(Request $request)
    {
        $site=new Site();                
        
        $form= $this->createForm(SiteType::class,$site,array("required"=>false));
        
        $form->handleRequest($request);
        
        // validation des champs du formulaire
        if($form->isValid())
        {
            $em=  $this->getDoctrine()->getManager();
            $em->persist($site);
            $em->flush();
                        
            echo "Le site: ".$site->getNomSite()." a bien été ajouté";
        }
        
        // affichage du formulaire
        // on passe la méthode d'affichage à la vue pour qu'elle puisse l'afficher
        
        return $this->render('OPTEquipementsBundle:sites:addSiteForm.html.twig',
                                array('form'=>$form->createView()));        
    }
    
    public function ListerAction()
    {
        $listeSites=new Site();
        $repo=  $this->getDoctrine()->getRepository('OPTEquipementsBundle:Site');
        $listeSites=$repo->findAll();
        return $this->render('OPTEquipementsBundle:sites:listeSites.html.twig',array('listeSites'=>$listeSites));
    }
    
    
}
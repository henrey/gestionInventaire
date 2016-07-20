<?php
namespace OPT\EquipementsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use OPT\EquipementsBundle\Form\IdentificationType;
use OPT\EquipementsBundle\Entity\Identification;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class IdentificationsController extends Controller
{
    public function AddAction(Request $request)
    {
        $identitfication=new Identification();
        
        $form=  $this->createForm(IdentificationType::class,$identitfication);
        //$form->add('save',  SubmitType::class,array('label'=>'Enregistrer'));
        
        $form->handleRequest($request);
        
        
        
        if($form->isValid())
        {
            
            $em=  $this->getDoctrine()
                    ->getManager();
            $em->persist($identitfication);
            $em->flush();
        }
        
        
        return $this->render('OPTEquipementsBundle:identifications:addIdentification.html.twig',
                array('form'=>$form->createView()));        
    }
}
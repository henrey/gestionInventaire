<?php
namespace OPT\EquipementsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use OPT\EquipementsBundle\Entity\Equipement;
//use OPT\EquipementsBundle\Form\EquipementType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

use OPT\EquipementsBundle\Form\IdentificationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Tests\JsonSerializableObject;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class EquipementsController extends Controller
{
    public function AddAction(Request $request)
    {
        $equipement=new Equipement();        
        $em=$this->getDoctrine()
                ->getManager();
        
        $repo=$em->getRepository('OPTEquipementsBundle:Salle');
        $listeSalles=$repo->findAll();
        
        $repo=$em->getRepository('OPTEquipementsBundle:Constructeur');
        $listeConstructeurs=$repo->findAll();
        
        $repo=$em->getRepository('OPTEquipementsBundle:Contrat');
        $listeContrats=$repo->findAll();       
        
        $repo=$em->getRepository('OPTEquipementsBundle:Identification');        
        $listeArmoiresIdentification=$repo->findBy(array('isArmoire'=>true));
        
        $form=$this->createFormBuilder($equipement,array('required'=>false))
                ->add('identification',  IdentificationType::class)
                ->add('type',  TextType::class,array('label'=>'Type equipement'))
                ->add('salle',  ChoiceType::class,
                                        ['choices'=>[$listeSalles],
                                        'choice_label'=>'Nom salle',                                        
                                        'group_by'=>function($s){
                                        return $s->getSite()->getNomSite();}])
                //->add('nomLogique',  TextType::class)
                ->add('commentaire', TextareaType::class,array('label'=>'Commentaires'))
                ->add('uDepart',  TextType::class,array('label'=>'U de départ'))
                ->add('nbU',  TextType::class,array('label'=>'Nombre de U'))
                ->add('installation',  DateType::class,array('label'=>'Date d\'installation'))
                ->add('qui',  TextType::class,array('label'=>'Installé par'))
                // Dans le cas d'un matériel -> on affiche l'armoire contenant
                ->add('contenuDans', ChoiceType::class,array( 
                                    'choices'=>[$listeArmoiresIdentification],
                                    'choice_label'=>'nomLogique',
                                    
                                    'group_by' => function(){ return null;},
                                    'placeholder'=>'contenu dans'))
                ->add('constructeur',  ChoiceType::class,
                                        ['choices'=>[$listeConstructeurs],
                                        'choice_label'=>'nomConstructeur',
                                        'group_by' => function(){ return null;},
                                        'choice_value'=>'id'
                                        ])
                ->add('contrat',  ChoiceType::class,
                                        ['choices'=>[$listeContrats],
                                        'choice_label'=>'nomContrat',
                                        'group_by' => function(){ return null;},
                                        ])
                ->add('dateDebutContrat',  DateType::class,array('label'=>'Date début de contrat','placeholder'=>''))
                ->add('remarque',  TextType::class, array('label'=>'Remarque'))
                ->add('save',  SubmitType::class,array('label'=>'Enregistrer'))
                ->getForm();       
        $form->handleRequest($request);
        
        if($form->isValid())
        {
            $equipement->setActif(true);            
            $highestId=$em->createQueryBuilder()
                    ->select('MAX (e.idContenant)')
                    ->from('OPTEquipementsBundle:Equipement','e')
                    ->getQuery()
                    ->getSingleScalarResult();                    
            $equipement->setIdContenant($highestId+1);
            if($equipement->getContenuDans()!=null)
            {
                $repo=$em->getRepository('OPTEquipementsBundle:Identification');
                $armoire=$repo->find($equipement->getContenuDans());
                $equipement->setNomContenuDans($armoire->getNomLogique());
            }
            
            
            $em->persist($equipement);
            $em->flush();
            $this->addFlash(
            'notice',
            "Equipement: ".$equipement->getNomLogique()." bien enregistrée");
            return $this->render('OPTEquipementsBundle:equipements:detailEquipement.html.twig',['equipement'=>$equipement]);            
        }      
        return $this->render('OPTEquipementsBundle:equipements:addEquipement.html.twig',array('form'=>$form->createView()));           
    }
    
    /**
     * @Route("/deleteEquipement/{id}") 
     */
    public function DeleteAction($id)
    {
             
        $repository=  $this->getDoctrine()
                ->getManager()
                ->getRepository('OPTEquipementsBundle:Equipement');        
        $equipement=$repository->find($id);
        $listeContenu=$repository->findBy(array('contenuDans'=>$id));
        foreach ($listeContenu as $contenu)
        {
            $this->getDoctrine()->getEntityManager()->remove($contenu);
        }
        $this->getDoctrine()->getEntityManager()->flush();
        $this->getDoctrine()->getEntityManager()->remove($equipement);
        $this->getDoctrine()->getEntityManager()->flush();
        $this->addFlash('notice', "Equipement "." supprimé!");
        
        return $this->redirectToRoute('liste_equipements');
    }

    /**
     * @Route("/detailEquipement/{id}")
     */
    public function DetailAction($id)
    {
        
        $repository=  $this->getDoctrine()
                ->getManager()
                ->getRepository('OPTEquipementsBundle:Equipement');        
        $equipement=$repository->find($id);
        return $this->render('OPTEquipementsBundle:equipements:detailEquipement.html.twig',['equipement'=>$equipement]);        
    }
    
    public function ListerAction($tri)
    {
        $em=  $this->getDoctrine()->getEntityManager();
        $repository=  $this->getDoctrine()
                ->getManager()
                ->getRepository('OPTEquipementsBundle:Equipement');        
        $listeEquipements=$repository->findBy(array('actif'=>true),array($tri=>'DESC'));   //'dateModification'=>'DESC'
        $nombreResultats=count($listeEquipements);
        return $this->render('OPTEquipementsBundle:equipements:listeEquipements.html.twig',
        ["listeEquipements"=>$listeEquipements,'nombreResultats'=>$nombreResultats]);
    }
    
    
    public function getSitesEntities()
    {
        return $this->getDoctrine()
                ->getManager()
                ->getRepository('OPTEquipementsBundle:Site')
                ->findAll();                
    }
    
    public function ModifierAction(Request $request,$id)
    {       
        $em=$this->getDoctrine()
                ->getManager();
        
        $repo=$em->getRepository('OPTEquipementsBundle:Salle');
        $listeSalles=$repo->findAll();        
        $repo=$em->getRepository('OPTEquipementsBundle:Constructeur');
        $listeConstructeurs=$repo->findAll();        
        $repo=$em->getRepository('OPTEquipementsBundle:Contrat');
        $listeContrats=$repo->findAll();        
        $repo=$em->getRepository('OPTEquipementsBundle:Equipement');
        $oldEquip=$repo->find($id);
        
        $repo=$em->getRepository('OPTEquipementsBundle:Identification');
        $listeArmoiresIdentification=$repo->findBy(array('isArmoire'=>true));
        
        $equipement=new Equipement();
        $equipement->setDateCreation($oldEquip->getDateCreation());
        
        $form=$this->createFormBuilder($equipement,array('required'=>false)) // désoblige d'entrer tous les champs
                ->add('identification',  IdentificationType::class,array('data'=>$oldEquip->getIdentification()))
                ->add('type',  TextType::class,array('label'=>'Type equipement','data'=>$oldEquip->getType()))
                ->add('salle',  ChoiceType::class,
                                        ['choices'=>[$listeSalles],
                                        'choice_label'=>'Nom salle',
                                            'data'=>$oldEquip->getSalle(),
                                        'group_by'=>function($s){
                                        return $s->getSite()->getNomSite();}])
                ->add('nomLogique',  TextType::class,array('label'=>'Nom logique','data'=>$oldEquip->getNomLogique()))
                ->add('commentaire', TextType::class,array('label'=>'Commentaires','data'=>$oldEquip->getCommentaire()))
                ->add('uDepart',  TextType::class,array('label'=>'U de départ','data'=>$oldEquip->getUDepart()))
                ->add('nbU',  TextType::class,array('label'=>'Nombre de U','data'=>$oldEquip->getNbU()))                
                ->add('installation',  DateType::class,array('label'=>'Date d\'installation','data'=>$oldEquip->getInstallation(),'placeholder'=>''))
                ->add('qui',  TextType::class,array('label'=>'Installé par','data'=>$oldEquip->getQui()))                
                // Dans le cas d'un matériel -> on affiche l'armoire contenant
                ->add('contenuDans', ChoiceType::class,array( //  contenuDans de type int, prend la valeur idContenant de l'équipement armoire
                                    'choices'=>[$listeArmoiresIdentification],                    
                                    'choice_label'=>'nomLogique',
                                    //'choice_value'=>'idContenant',
                                    'group_by' => function(){ return null;},
                                    'data'=>$oldEquip->getContenuDans(),
                                    'placeholder'=>'contenu dans'
                                    ))
                ->add('constructeur',  ChoiceType::class,
                                        ['choices'=>[$listeConstructeurs],
                                        'choice_label'=>'nomConstructeur',
                                        'group_by' => function(){ return null;},
                                        'choice_value'=>'id','data'=>$oldEquip->getConstructeur()
                                        ])
                ->add('contrat',  ChoiceType::class,
                                        ['choices'=>[$listeContrats],
                                        'choice_label'=>'nomContrat',
                                        'group_by' => function(){ return null;},
                                        'data'=>$oldEquip->getContrat()
                                        ])
                ->add('dateDebutContrat',  DateType::class,array('label'=>'Date début de contrat','data'=>$oldEquip->getDateDebutContrat(),'placeholder'=>''))
                ->add('save',  SubmitType::class,array('label'=>'Enregistrer'))
                ->getForm();       
        
        $form->handleRequest($request);
                
        if($form->isValid())
        {            
            $equipement->setActif(true);
            $oldEquip->setActif(false);
            $equipement->setIdContenant($oldEquip->getIdContenant());
            
            if($equipement->getContenuDans()!=null)
            {
                $repo=$em->getRepository('OPTEquipementsBundle:Identification');
                $armoire=$repo->find($equipement->getContenuDans());
                $equipement->setNomContenuDans($armoire->getNomLogique());
            }
            
            $em->persist($equipement);
            $em->flush();
            $this->addFlash(
            'notice',
            "Equipement: ".$equipement->getNomLogique()." a bien été modifié");
            
            return $this->render('OPTEquipementsBundle:equipements:detailEquipement.html.twig',['equipement'=>$equipement]);            
        }      
        return $this->render('OPTEquipementsBundle:equipements:addEquipement.html.twig',array('form'=>$form->createView()));           
    }
    
    /**
     * @Route("/historiqueEquipement/{id}")
     * @param type $id
     * @return type
     */
    public function HistoriqueAction($id)
    {
        $repository=  $this->getDoctrine()->getManager()->getRepository('OPTEquipementsBundle:Equipement');
        $equipement=$repository->find($id);
        $listeEquipements=$repository->findBy(array('identification'=>$equipement->getIdentification()),array('dateModification'=>'DESC'));        
        //return $this->render('OPTEquipementsBundle:equipements:historiqueEquipements.html.twig',
        $nombreResultats=-1;
        return $this->render('OPTEquipementsBundle:equipements:listeEquipements.html.twig',
        ["listeEquipements"=>$listeEquipements,"equipement"=>$equipement,'nombreResultats'=>$nombreResultats]);
    }
    
    public function RechercheAction($critere)
    {
        return $this->render('OPTEquipementsBundle:recherche:rechercheForm.html.twig',array('critere'=>$critere));
    }
}
<?php

namespace OPT\EquipementsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use OPT\EquipementsBundle\Entity\Equipement;
use OPT\EquipementsBundle\Entity\Recherche;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;

class RechercheController extends Controller
{
    public function indexAction()
    {
        $listeEquipements=new Equipement();
        
        $repository=  $this->getDoctrine()->getManager()->getRepository('OPTEquipementsBundle:Equipement');
        $listeEquipements=$repository->findAll();
        
        return $this->render('OPTEquipementsBundle:Default:ListeAcceuil.html.twig',
        ["listeEquipements"=>$listeEquipements]);
        
    }
    public function RechercheEquipementsAction(Request $request )
    {
       $em=  $this->getDoctrine()->getManager();
            $repo=$em->getRepository('OPTEquipementsBundle:Equipement');           
            // requetes sur critere en base
            /*$requete=$em->createQuery("SELECT e FROM OPT\EquipementsBundle\Entity\Equipement e "                    
                    . "WHERE e.actif=true "
                    . "AND (e.commentaire "
                    . "LIKE :critere "
                    . "or e.type LIKE :critere "
                    . "or e.nomSalle LIKE :critere "
                    . "or e.uDepart LIKE :critere "
                    . "or e.nbU LIKE :critere "
                    . "or e.nomLogique LIKE :critere "
                    . "or e.qui LIKE :critere "
                    . "or e.dateDebutContrat LIKE :critere "
                    . "or e.dateCreation LIKE :critere "
                    . "or e.dateModification LIKE :critere"
                    . "or e.constructeur.nomConstructeur LIKE :critere) "
                    );
            
            $requete->setParameter('critere','%'.$request->get('critere').'%');            
            $listeEquipements=$requete->getResult();*/
            
            $qb=$em->createQueryBuilder();
            
            $listeEquipements=$qb->select('e')
                    ->from('OPTEquipementsBundle:Equipement','e')
                    ->setParameter('critere','%'.$request->get('critere').'%')
                    ->where('e.actif = 1')                    
                    ->andWhere($qb->expr()->orX(
                            'e.commentaire LIKE :critere ',
                            'e.type LIKE :critere',
                            " e.nomSalle LIKE :critere ",
                            " e.uDepart LIKE :critere ",
                            " e.nbU LIKE :critere ",
                            " e.nomLogique LIKE :critere ",
                            " e.qui LIKE :critere ",
                            " e.dateDebutContrat LIKE :critere ",
                            " e.dateCreation LIKE :critere ",
                            " e.dateModification LIKE :critere"
                            ))
                    ->getQuery()->getResult();
            
            
            $nombreResultats=  count($listeEquipements);
            return $this->render('OPTEquipementsBundle:equipements:listeEquipements.html.twig',
                    array("listeEquipements"=>$listeEquipements,'nombreResultats'=>$nombreResultats));
        
    }
}
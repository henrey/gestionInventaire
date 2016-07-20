<?php

namespace OPT\EquipementsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use OPT\EquipementsBundle\Entity\Salle;
/**
 * Description of getTableService
 *
 * @author Henrey
 */


class getTableService extends Controller{
    //put your code here
    
    /**
     * 
     * @return type
     */
    public function getSallesEntities()
    {
        $listEntities=new Salle();
        $repo=  $this->getDoctrine()->getManager()->getRepository('OPTEquipementsBundle:Salle');
        $listEntities=$repo->findAll();
        return $listEntities;
    }
}

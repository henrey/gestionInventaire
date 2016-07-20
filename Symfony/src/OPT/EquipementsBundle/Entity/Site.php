<?php

namespace OPT\EquipementsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use OPT\EquipementsBundle\Services\entityService;

/**
 * Site
 *
 * @ORM\Table(name="site")
 * @ORM\Entity(repositoryClass="OPT\EquipementsBundle\Repository\SiteRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Site
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_site", type="string", length=50)
     */
    private $nom_site;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

 

    /**
     * Get nomSite
     *
     * @return string
     */
    public function getNomSite()
    {
        return $this->nom_site;
    }

    

    /**
     * Set nomSite
     *
     * @param string $nomSite
     *
     * @return Site
     */
    public function setNomSite($nomSite)
    {
        $this->nom_site = $nomSite;

        return $this;
    }
    
    
    
}

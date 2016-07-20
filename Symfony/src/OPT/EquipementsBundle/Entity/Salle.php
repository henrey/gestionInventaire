<?php

namespace OPT\EquipementsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use OPT\EquipementsBundle\Entity\Site;

/**
 * Salle
 *
 * @ORM\Table(name="salle")
 * @ORM\Entity(repositoryClass="OPT\EquipementsBundle\Repository\SalleRepository")
 */
class Salle
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
     * @ORM\Column(name="nom_salle", type="string", length=50,nullable=true)
     */
    private $nomSalle;
    
    /**
     * @ORM\ManyToOne(targetEntity="OPT\EquipementsBundle\Entity\Site")
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private $site;


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
     * Set nomSalle
     *
     * @param string $nomSalle
     *
     * @return Salle
     */
    public function setNomSalle($nomSalle)
    {
        $this->nomSalle = $nomSalle;

        return $this;
    }

    /**
     * Get nomSalle
     *
     * @return string
     */
    public function getNomSalle()
    {
        return $this->nomSalle;
    }
    


    /**
     * Set site
     *
     * @param \OPT\EquipementsBundle\Entity\Site $site
     *
     * @return Salle
     */
    public function setSite(\OPT\EquipementsBundle\Entity\Site $site = null)
    {
        $this->site = $site;

        return $this;
    }

    /**
     * Get site
     *
     * @return \OPT\EquipementsBundle\Entity\Site
     */
    public function getSite()
    {
        return $this->site;
    }
}

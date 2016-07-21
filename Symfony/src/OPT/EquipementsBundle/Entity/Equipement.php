<?php

namespace OPT\EquipementsBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Event\PreUpdateEventArgs;

use Doctrine\ORM\Mapping as ORM;

/**
 * Equipement
 *
 * @ORM\Table(name="equipement")
 * @ORM\Entity(repositoryClass="OPT\EquipementsBundle\Repository\EquipementRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Equipement extends \Symfony\Bundle\FrameworkBundle\Controller\Controller
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
     * @ORM\Column(name="type", type="string", length=30,nullable=true)
     */
    private $type;

    /**
     * @var string
     * 
     * @ORM\Column(name="commentaire", type="string", length=100,nullable=true)
     */
    private $commentaire;

    /**
     * @var int
     * 
     * @ORM\Column(name="uDepart", type="integer",nullable=true)
     */
    private $uDepart;

    /**
     * @var int
     *
     * @ORM\Column(name="nbU", type="integer",nullable=true)
     */
    private $nbU;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="installation", type="date",nullable=true)
     */
    private $installation;

    /**
     * @var string
     *
     * @ORM\Column(name="qui", type="string", length=20,nullable=true)
     */
    private $qui;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebutContrat", type="date",nullable=true)
     */
    private $dateDebutContrat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime",nullable=true)
     */
    private $dateCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateModification", type="datetime",nullable=true)
     */
    private $dateModification;
    
    
    /**
     *
     * @var string
     * @ORM\Column(name="nomContenuDans", type="string", length=15, nullable=true)
     */
    private $nomContenuDans;
    
    /**
     * @var bool
     *
     * @ORM\Column(name="actif", type="boolean",nullable=true)
     */
    private $actif=false;
    
    /**
     * @var type
     * @ORM\Column(name="nomSalle", type="string",length=20, nullable=true)      
     */
    private $nomSalle;    // Stockage du nom de la salle pour éviter l'appel à $e.getSalle.getNomSalle() 
    
    /**
     *
     * @var type 
     * @ORM\Column(name="nomLogique", type="string",length=50, nullable=true)
     */
    private $nomLogique;
    
    /**
     *
     * @var type 
     * @ORM\Column(name="remarque", type="string",length=20, nullable=true)
     */
    private $remarque;
    
    /**
     *
     * @var int
     * @ORM\Column(name="idContenant", type="string",length=9, nullable=true)
     */
    private $idContenant;
    
    
    
    ////////// Liens étrangés ///////////
    
    /**
    * @ORM\ManyToOne(targetEntity="OPT\EquipementsBundle\Entity\Salle", cascade="persist")
    * @ORM\JoinColumn(onDelete="SET NULL")
    */
    private $salle;
    
    /**
    * @ORM\ManyToOne(targetEntity="OPT\EquipementsBundle\Entity\Constructeur")
    */
    private $constructeur;
    
    /**
    * @ORM\ManyToOne(targetEntity="OPT\EquipementsBundle\Entity\Contrat")
    */
    private $contrat;
    
    /**
     * @ORM\ManyToOne(targetEntity="OPT\EquipementsBundle\Entity\Identification",cascade={"persist" , "remove"})
     */
    private $identification;
    
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="OPT\EquipementsBundle\Entity\Identification",cascade={"persist" , "remove"})
     */
    private $contenuDans;
    
    
    
    
    public function __construct() 
    {
        $this->dateCreation = new \DateTime();
        $this->dateModification=new \DateTime();
        
        
        
    }


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
     * Set type
     *
     * @param string $type
     *
     * @return Equipement
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Equipement
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set uDepart
     *
     * @param integer $uDepart
     *
     * @return Equipement
     */
    public function setUDepart($uDepart)
    {
        $this->uDepart = $uDepart;

        return $this;
    }

    /**
     * Get uDepart
     *
     * @return int
     */
    public function getUDepart()
    {
        return $this->uDepart;
    }

    /**
     * Set nbU
     *
     * @param integer $nbU
     *
     * @return Equipement
     */
    public function setNbU($nbU)
    {
        $this->nbU = $nbU;

        return $this;
    }

    /**
     * Get nbU
     *
     * @return int
     */
    public function getNbU()
    {
        return $this->nbU;
    }

    /**
     * Set nomLogique
     *
     * @param string $nomLogique
     *
     * @return Equipement
     */
    public function setNomLogique($nomLogique)
    {
        $this->nomLogique = $nomLogique;

        return $this;
    }

    /**
     * Get nomLogique
     *
     * @return string
     */
    public function getNomLogique()
    {
        return $this->nomLogique;
    }

    /**
     * Set installation
     *
     * @param \DateTime $installation
     *
     * @return Equipement
     */
    public function setInstallation($installation)
    {
        $this->installation = $installation;

        return $this;
    }

    /**
     * Get installation
     *
     * @return \DateTime
     */
    public function getInstallation()
    {
        return $this->installation;
    }

    /**
     * Set qui
     *
     * @param string $qui
     *
     * @return Equipement
     */
    public function setQui($qui)
    {
        $this->qui = $qui;

        return $this;
    }

    /**
     * Get qui
     *
     * @return string
     */
    public function getQui()
    {
        return $this->qui;
    }

    /**
     * Set dateDebutContrat
     *
     * @param \DateTime $dateDebutContrat
     *
     * @return Equipement
     */
    public function setDateDebutContrat($dateDebutContrat)
    {
        $this->dateDebutContrat = $dateDebutContrat;

        return $this;
    }

    /**
     * Get dateDebutContrat
     *
     * @return \DateTime
     */
    public function getDateDebutContrat()
    {
        return $this->dateDebutContrat;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return Equipement
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set dateModification
     *
     * @param \DateTime $dateModification
     *
     * @return Equipement
     */
    public function setDateModification($dateModification)
    {
        $this->dateModification = $dateModification;

        return $this;
    }

    /**
     * Get dateModification
     *
     * @return \DateTime
     */
    public function getDateModification()
    {
        return $this->dateModification;
    }
    

    /**
     * Set actif
     *
     * @param boolean $actif
     *
     * @return Equipement
     */
    public function setActif($actif)
    {
        $this->actif = $actif;

        return $this;
    }

    /**
     * Get actif
     *
     * @return bool
     */
    public function getActif()
    {
        return $this->actif;
    }

    /**
     * Set salle
     *
     * @param \OPT\EquipementsBundle\Entity\Salle $salle
     *
     * @return Equipement
     */
    public function setSalle(\OPT\EquipementsBundle\Entity\Salle $salle = null)
    {
        $this->salle = $salle;

        return $this;
    }

    /**
     * Get salle
     *
     * @return \OPT\EquipementsBundle\Entity\Salle
     */
    public function getSalle()
    {
        return $this->salle;
    }

    /**
     * Set constructeur
     *
     * @param \OPT\EquipementsBundle\Entity\Constructeur $constructeur
     *
     * @return Equipement
     */
    public function setConstructeur(\OPT\EquipementsBundle\Entity\Constructeur $constructeur = null)
    {
        $this->constructeur = $constructeur;

        return $this;
    }

    /**
     * Get constructeur
     *
     * @return \OPT\EquipementsBundle\Entity\Constructeur
     */
    public function getConstructeur()
    {
        return $this->constructeur;
    }

    /**
     * Set contrat
     *
     * @param \OPT\EquipementsBundle\Entity\Contrat $contrat
     *
     * @return Equipement
     */
    public function setContrat(\OPT\EquipementsBundle\Entity\Contrat $contrat = null)
    {
        $this->contrat = $contrat;

        return $this;
    }

    /**
     * Get contrat
     *
     * @return \OPT\EquipementsBundle\Entity\Contrat
     */
    public function getContrat()
    {
        return $this->contrat;
    }

    /**
     * Set identification
     *
     * @param \OPT\EquipementsBundle\Entity\Identification $identification
     *
     * @return Equipement
     */
    public function setIdentification(\OPT\EquipementsBundle\Entity\Identification $identification = null)
    {
        $this->identification = $identification;

        return $this;
    }

    /**
     * Get identification
     *
     * @return \OPT\EquipementsBundle\Entity\Identification
     */
    public function getIdentification()
    {
        return $this->identification;
    }
    
    
    
    /*public function updateDateModification()
    {
        $this->dateModification=new \DateTime();
    }*/
    
    
    /**
     * @ORM\PreUpdate
     */
    
    public function preUpdate(PreUpdateEventArgs $event)
    {
        if($event->hasChangedField('actif'))
        {
            return;
        }
        else
        {
            $this->dateModification=new \DateTime();
        }
    }
    
    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        if($this->getSalle()!=null)
        {
            $this->setNomSalle($this->getSalle()->getNomSalle());
        }
        else 
        {
            $this->setNomSalle("Pas de salle");
        }
        if($this->getIdentification()==null)
        {
            $this->setIdentification(new Identification());
        }
        if($this->getSalle()==null) $this->setSalle (new Salle());
        if($this->getConstructeur()==null) $this->setSalle (new Salle());
        if($this->getContrat()==null) $this->setContrat (new Contrat ());
        if($this->contenuDans==null) $this->getIdentification ()->setIsArmoire (TRUE);
    }


    /**
     * Set nomSalle
     *
     * @param string $nomSalle
     *
     * @return Equipement
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
     * Set remarque
     *
     * @param string $remarque
     *
     * @return Equipement
     */
    public function setRemarque($remarque)
    {
        $this->remarque = $remarque;

        return $this;
    }

    /**
     * Get remarque
     *
     * @return string
     */
    public function getRemarque()
    {
        return $this->remarque;
    }

    /**
     * Set idContenant
     *
     * @param integer $idContenant
     *
     * @return Equipement
     */
    public function setIdContenant($idContenant)
    {
        $this->idContenant = $idContenant;

        return $this;
    }

    /**
     * Get idContenant
     *
     * @return integer
     */
    public function getIdContenant()
    {
        return $this->idContenant;
    }

    /**
     * Set contenuDans
     *
     * @param integer $contenuDans
     *
     * @return Equipement
     */
    public function setContenuDans($contenuDans)
    {
        $this->contenuDans = $contenuDans;

        return $this;
    }

    /**
     * Get contenuDans
     *
     * @return integer
     */
    public function getContenuDans()
    {
        return $this->contenuDans;
    }

    /**
     * Set nomContenuDans
     *
     * @param string $nomContenuDans
     *
     * @return Equipement
     */
    public function setNomContenuDans($nomContenuDans)
    {
        $this->nomContenuDans = $nomContenuDans;

        return $this;
    }

    /**
     * Get nomContenuDans
     *
     * @return string
     */
    public function getNomContenuDans()
    {
        return $this->nomContenuDans;
    }
}

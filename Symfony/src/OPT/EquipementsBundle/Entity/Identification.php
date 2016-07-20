<?php

namespace OPT\EquipementsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Identification
 *
 * @ORM\Table(name="identification")
 * @ORM\Entity(repositoryClass="OPT\EquipementsBundle\Repository\IdentificationRepository")
 */
class Identification
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
     * @ORM\Column(name="model", type="string", length=30,nullable=true)
     */
    private $model;
    
    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=30,nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="serie", type="string", length=30,nullable=true)
     */
    private $serie;

    /**
     * @var string
     *
     * @ORM\Column(name="numeroImmo", type="string", length=35,nullable=true)
     */
    private $numeroImmo;
    
    /**
     * @var string
     *
     * @ORM\Column(name="nomLogique", type="string", length=35,nullable=true)
     */
    private $nomLogique;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFinGarantie", type="date",nullable=true)
     */
    private $dateFinGarantie;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="isArmoire", type="boolean",nullable=true)
     */
    private $isArmoire=false;
    
    public function __construct() 
    {
        $this->model=null;
        $this->numeroImmo=null;
        $this->serie=null;
        
        ;
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
     * Set model
     *
     * @param string $model
     *
     * @return Identification
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model
     *
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set serie
     *
     * @param string $serie
     *
     * @return Identification
     */
    public function setSerie($serie)
    {
        $this->serie = $serie;

        return $this;
    }

    /**
     * Get serie
     *
     * @return string
     */
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * Set numeroImmo
     *
     * @param string $numeroImmo
     *
     * @return Identification
     */
    public function setNumeroImmo($numeroImmo)
    {
        $this->numeroImmo = $numeroImmo;

        return $this;
    }

    /**
     * Get numeroImmo
     *
     * @return string
     */
    public function getNumeroImmo()
    {
        return $this->numeroImmo;
    }

    /**
     * Set dateFinGarantie
     *
     * @param \DateTime $dateFinGarantie
     *
     * @return Identification
     */
    public function setDateFinGarantie($dateFinGarantie)
    {
        $this->dateFinGarantie = $dateFinGarantie;

        return $this;
    }

    /**
     * Get dateFinGarantie
     *
     * @return \DateTime
     */
    public function getDateFinGarantie()
    {
        return $this->dateFinGarantie;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Identification
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
     * Set nomLogique
     *
     * @param string $nomLogique
     *
     * @return Identification
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
     * Set isArmoire
     *
     * @param boolean $isArmoire
     *
     * @return Identification
     */
    public function setIsArmoire($isArmoire)
    {
        $this->isArmoire = $isArmoire;

        return $this;
    }

    /**
     * Get isArmoire
     *
     * @return boolean
     */
    public function getIsArmoire()
    {
        return $this->isArmoire;
    }
}

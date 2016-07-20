<?php

namespace OPT\EquipementsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contrat
 *
 * @ORM\Table(name="contrat")
 * @ORM\Entity(repositoryClass="OPT\EquipementsBundle\Repository\ContratRepository")
 */
class Contrat
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
     * @ORM\Column(name="nomContrat", type="string", length=20)
     */
    private $nomContrat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFinContrat", type="date")
     */
    private $dateFinContrat;


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
     * Set nomContrat
     *
     * @param string $nomContrat
     *
     * @return Contrat
     */
    public function setNomContrat($nomContrat)
    {
        $this->nomContrat = $nomContrat;

        return $this;
    }

    /**
     * Get nomContrat
     *
     * @return string
     */
    public function getNomContrat()
    {
        return $this->nomContrat;
    }

    /**
     * Set dateFinContrat
     *
     * @param \DateTime $dateFinContrat
     *
     * @return Contrat
     */
    public function setDateFinContrat($dateFinContrat)
    {
        $this->dateFinContrat = $dateFinContrat;

        return $this;
    }

    /**
     * Get dateFinContrat
     *
     * @return \DateTime
     */
    public function getDateFinContrat()
    {
        return $this->dateFinContrat;
    }
}


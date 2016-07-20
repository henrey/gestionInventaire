<?php

namespace OPT\EquipementsBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

/**
 * Constructeur
 *
 * @ORM\Table(name="constructeur")
 * @ORM\Entity(repositoryClass="OPT\EquipementsBundle\Repository\ConstructeurRepository")
 */
class Constructeur
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
     * @Assert\Length(min=3)
     * @ORM\Column(name="nomConstructeur", type="string", length=26)
     */
    private $nomConstructeur;


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
     * Set nomConstructeur
     *
     * @param string $nomConstructeur
     *
     * @return Constructeur
     */
    public function setNomConstructeur($nomConstructeur)
    {
        $this->nomConstructeur = $nomConstructeur;

        return $this;
    }

    /**
     * Get nomConstructeur
     *
     * @return string
     */
    public function getNomConstructeur()
    {
        return $this->nomConstructeur;
    }
}


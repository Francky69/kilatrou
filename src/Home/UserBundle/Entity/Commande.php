<?php

namespace Home\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Commande
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date", type="datetime")
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="Etat", type="integer")
     */
    private $etat;

    /**
     * @var string
     *
     * @ORM\Column(name="Adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="CodePostal", type="string", length=255)
     */
    private $codePostal;

    /**
     * @var string
     *
     * @ORM\Column(name="Ville", type="string", length=255)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="Pays", type="string", length=255)
     */
    private $pays;

    /**
     * @var integer
     *
     * @OneToOne(targetEntity="User")
     * @JoinColumn(name="id_user", referencedColumnName="id")
     */
    private $idUser;

    /**
     * @var string
     *
     * @OneToOne(targetEntity="Product")
     * @JoinColumn(name="id_product", referencedColumnName="id")
     */
    private $idProduct;

    /**
     * @var string
     *
     * @ORM\Column(name="PrixTotal", type="decimal")
     */
    private $prixTotal;

    /**
     * @var string
     *
     * @ORM\Column(name="FraisPort", type="decimal")
     */
    private $fraisPort;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Commande
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set etat
     *
     * @param integer $etat
     * @return Commande
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    
        return $this;
    }

    /**
     * Get etat
     *
     * @return integer 
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Commande
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    
        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set codePostal
     *
     * @param string $codePostal
     * @return Commande
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;
    
        return $this;
    }

    /**
     * Get codePostal
     *
     * @return string 
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set ville
     *
     * @param string $ville
     * @return Commande
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
    
        return $this;
    }

    /**
     * Get ville
     *
     * @return string 
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set pays
     *
     * @param string $pays
     * @return Commande
     */
    public function setPays($pays)
    {
        $this->pays = $pays;
    
        return $this;
    }

    /**
     * Get pays
     *
     * @return string 
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set idUser
     *
     * @param integer $idUser
     * @return Commande
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    
        return $this;
    }

    /**
     * Get idUser
     *
     * @return integer 
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set idProduct
     *
     * @param string $idProduct
     * @return Commande
     */
    public function setIdProduct($idProduct)
    {
        $this->idProduct = $idProduct;
    
        return $this;
    }

    /**
     * Get idProduct
     *
     * @return string 
     */
    public function getIdProduct()
    {
        return $this->idProduct;
    }

    /**
     * Set prixTotal
     *
     * @param string $prixTotal
     * @return Commande
     */
    public function setPrixTotal($prixTotal)
    {
        $this->prixTotal = $prixTotal;
    
        return $this;
    }

    /**
     * Get prixTotal
     *
     * @return string 
     */
    public function getPrixTotal()
    {
        return $this->prixTotal;
    }

    /**
     * Set fraisPort
     *
     * @param string $fraisPort
     * @return Commande
     */
    public function setFraisPort($fraisPort)
    {
        $this->fraisPort = $fraisPort;
    
        return $this;
    }

    /**
     * Get fraisPort
     *
     * @return string 
     */
    public function getFraisPort()
    {
        return $this->fraisPort;
    }
}

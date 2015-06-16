<?php

namespace eDemy\BackgroundBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use eDemy\MainBundle\Entity\BaseEntity;

/**
 * @ORM\Entity(repositoryClass="eDemy\BackgroundBundle\Entity\BackgroundRepository")
 * @ORM\Table()
 */
class Background extends BaseEntity
{
    public function __construct($em = null)
    {
        parent::__construct($em);
        $this->imagenes = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="Imagen", mappedBy="background", cascade={"persist","remove"})
     */
    protected $imagenes;


    public function getImagenes()
    {
        return $this->imagenes;
    }

    public function addImagen(Imagen $imagen)
    {
        $imagen->setBackground($this);
        $this->imagenes->add($imagen);
    }

    public function removeImagen(Imagen $imagen)
    {
        $this->imagenes->removeElement($imagen);
        $this->getEntityManager()->remove($imagen);
    }
    
    
    public function showImagenesInPanel()
    {
        return true;
    }
}

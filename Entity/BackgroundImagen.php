<?php

namespace eDemy\BackgroundBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;
use eDemy\MainBundle\Entity\BaseImagen;

/**
 * @ORM\Table("BackgroundImagen")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class BackgroundImagen extends BaseImagen
{
    /**
     * @ORM\ManyToOne(targetEntity="eDemy\BackgroundBundle\Entity\Background", inversedBy="imagenes")
     */
    protected $background;

    public function setBackground($background)
    {
        $this->background = $background;

        return $this;
    }

    public function getBackground()
    {
        return $this->background;
    }
    
    
    protected $webpath;
    
    public function showWebpathInForm()
    {
        return true;
    }
}

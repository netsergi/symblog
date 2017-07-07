<?php
// src/Blogger/BlogBundle/Entity/Autor.php

namespace Blogger\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="autors")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="Blogger\BlogBundle\Entity\AutorRepository")
 */
class Autor
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    protected $nom;

     /**
     * @ORM\Column(type="string", length=80)
     */
    protected $cognom;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $data_neixment;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $data_alta;   

    /**
     * @ORM\Column(type="string", length=80)
     */
    protected $foto;

    /**
     * @ORM\Column(type="text")
     */
    protected $descripcio;
 
     /**
     * @ORM\OneToMany(targetEntity="Blog", mappedBy="author")
     * 
     */
    protected $blogs;

     public function __construct()
    {
        $this->blogs = new ArrayCollection();    
    }

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
     * Set nom
     *
     * @param string $nom
     *
     * @return Autor
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set cognom
     *
     * @param string $cognom
     *
     * @return Autor
     */
    public function setCognom($cognom)
    {
        $this->cognom = $cognom;

        return $this;
    }

    /**
     * Get cognom
     *
     * @return string
     */
    public function getCognom()
    {
        return $this->cognom;
    }

    /**
     * Set dataNeixment
     *
     * @param \DateTime $dataNeixment
     *
     * @return Autor
     */
    public function setDataNeixment($dataNeixment)
    {
        $this->data_neixment = $dataNeixment;

        return $this;
    }

    /**
     * Get dataNeixment
     *
     * @return \DateTime
     */
    public function getDataNeixment()
    {
        return $this->data_neixment;
    }

    /**
     * Set foto
     *
     * @param string $foto
     *
     * @return Autor
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * Get foto
     *
     * @return string
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set descripcio
     *
     * @param string $descripcio
     *
     * @return Autor
     */
    public function setDescripcio($descripcio)
    {
        $this->descripcio = $descripcio;

        return $this;
    }

    /**
     * Get descripcio
     *
     * @return string
     */
    public function getDescripcio()
    {
        return $this->descripcio;
    }

    /**
     * Set dataAlta
     *
     * @param \DateTime $dataAlta
     *
     * @return Autor
     */
    public function setDataAlta($dataAlta)
    {
        $this->data_alta = $dataAlta;

        return $this;
    }

    /**
     * Get dataAlta
     *
     * @return \DateTime
     */
    public function getDataAlta()
    {
        return $this->data_alta;
    }

    /**
     * Add blog
     *
     * @param \Blogger\BlogBundle\Entity\Blog $blog
     *
     * @return Autor
     */
    public function addBlog(\Blogger\BlogBundle\Entity\Blog $blog)
    {
        $this->blogs[] = $blog;

        return $this;
    }

    /**
     * Remove blog
     *
     * @param \Blogger\BlogBundle\Entity\Blog $blog
     */
    public function removeBlog(\Blogger\BlogBundle\Entity\Blog $blog)
    {
        $this->blogs->removeElement($blog);
    }

    /**
     * Get blogs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBlogs()
    {
        return $this->blogs;
    }
}

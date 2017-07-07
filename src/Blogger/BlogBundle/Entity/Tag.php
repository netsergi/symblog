<?php
// src/Blogger/BlogBundle/Entity/Blog.php

namespace Blogger\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="tags")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="Blogger\BlogBundle\Entity\TagRepository")
 */
class Tag
{
    /**
     * @ORM\Id

     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="Blog", mappedBy="tagsCol")
     * 
     */
    protected $blogs;

     /**
     * @ORM\Column(type="string")
     */
    protected $tagname;

  
    public function __construct() {
        $this->blogs = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set tagname
     *
     * @param string $tagname
     *
     * @return Tag
     */
    public function setTagname($tagname)
    {
        $this->tagname = $tagname;

        return $this;
    }

    /**
     * Get tagname
     *
     * @return string
     */
    public function getTagname()
    {
        return $this->tagname;
    }

    /**
     * Add blog
     *
     * @param \Blogger\BlogBundle\Entity\Blog $blog
     *
     * @return Tag
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

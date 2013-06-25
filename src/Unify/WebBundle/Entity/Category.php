<?php

namespace Unify\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Entity\Category
 *
 * @ORM\Entity(repositoryClass="Unify\WebBundle\Repository\CategoryRepository")
 * @ORM\Table(name="categories")
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    protected $name;
    
    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    protected $slug;
    
    /**
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\OrderBy({"order" = "DESC"})
     */
    protected $order = 0;
    
    /**
     * @ORM\OneToMany(targetEntity="Article", mappedBy="category")
     */
    protected $articles;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->articles = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Category
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set order
     *
     * @param integer $order
     * @return Category
     */
    public function setOrder($order)
    {
        $this->order = $order;
    
        return $this;
    }

    /**
     * Get order
     *
     * @return integer 
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Add articles
     *
     * @param \Unify\WebBundle\Entity\Article $articles
     * @return Category
     */
    public function addArticle(\Unify\WebBundle\Entity\Article $articles)
    {
        $this->articles[] = $articles;
    
        return $this;
    }

    /**
     * Remove articles
     *
     * @param \Unify\WebBundle\Entity\Article $articles
     */
    public function removeArticle(\Unify\WebBundle\Entity\Article $articles)
    {
        $this->articles->removeElement($articles);
    }

    /**
     * Get articles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArticles()
    {
        return $this->articles;
    }
}
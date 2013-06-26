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
    protected $show_order = 0;
    
    /**
     * @ORM\OneToMany(targetEntity="Product", mappedBy="category")
     */
    protected $products;
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
        $slug = strtolower(trim($slug));
        $slug = str_replace(array(' '), array('-'), $slug);
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
     * Add products
     *
     * @param \Unify\WebBundle\Entity\Product $products
     * @return Category
     */
    public function addProduct(\Unify\WebBundle\Entity\Product $products)
    {
        $this->products[] = $products;
    
        return $this;
    }

    /**
     * Remove products
     *
     * @param \Unify\WebBundle\Entity\Product $products
     */
    public function removeProduct(\Unify\WebBundle\Entity\Product $products)
    {
        $this->products->removeElement($products);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Set show_order
     *
     * @param integer $showOrder
     * @return Category
     */
    public function setShowOrder($showOrder)
    {
        $this->show_order = $showOrder;
    
        return $this;
    }

    /**
     * Get show_order
     *
     * @return integer 
     */
    public function getShowOrder()
    {
        return $this->show_order;
    }
    
    public function __toString() {
        return (String) $this->getName();
    }
}
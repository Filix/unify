<?php

namespace Unify\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * Entity\Product
 *
 * @ORM\Entity(repositoryClass="Unify\WebBundle\Repository\ProductRepository")
 * @ORM\Table(name="products")
 * @UniqueEntity(fields={"slug"},message="Slug has existed.")
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     * @Assert\NotNull(message="Slug Required.")
     * @Assert\Regex(
     *     pattern="/^[a-zA-Z0-9\-_]+$/",
     *     message="a-z,A-Z,0-9,-,_"
     * )
     */
    protected $slug;
    
    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     * @Assert\NotNull(message="Title Required.")
     */
    protected $title;
    
    /**
     * @ORM\Column(type="text", nullable=false)
     * @Assert\NotNull(message="Content Required.")
     */
    protected $content;
    
    /**
     * @ORM\Column(type="datetime")
     */
    protected $created_at;
    
    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $img;
    
    protected $old_img;
  
   /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="products")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=false)
     */
    protected $category;

    public function __construct() {
        $this->setCreatedAt(new \DateTime());
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
     * Set slug
     *
     * @param string $slug
     * @return Article
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
     * Set title
     *
     * @param string $title
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Article
     */
    public function setContent($content)
    {
        $this->content = $content;
    
        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Article
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    
        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set img
     *
     * @param string $img
     * @return Article
     */
    public function setImg($img)
    {
        if($this->old_img == null){
            $this->old_img = $this->img;
        }
        
        $this->img = $img;
    
        return $this;
    }
    
    public function getImgPath()
    {
        return '/uploads/' . $this->getImg();
    }
    
    public function getOldImg()
    {
        return $this->old_img;
    }

    /**
     * Get img
     *
     * @return string 
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * Set type
     *
     * @param smallint $type
     * @return Article
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return smallint 
     */
    public function getType()
    {
        return $this->type;
    }


    /**
     * Set category
     *
     * @param \Unify\WebBundle\Entity\Category $category
     * @return Product
     */
    public function setCategory(\Unify\WebBundle\Entity\Category $category)
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return \Unify\WebBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
}
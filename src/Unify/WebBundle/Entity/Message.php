<?php

namespace Unify\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Entity\Message
 *
 * @ORM\Entity(repositoryClass="Unify\WebBundle\Repository\MessageRepository")
 * @ORM\Table(name="messages")
 */
class Message
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=20, nullable=false)
     * @Assert\NotNull(message="Name Required.")
     * @Assert\MaxLength(
     *     limit=20,
     *     message="Equal or less than 20.|Equal or less than 20."
     * )
     */
    protected $name;
    
    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     * @Assert\NotNull(message="Email Required.")
     * @Assert\MaxLength(
     *     limit=100,
     *     message="Equal or less than 100.|Equal or less than 100."
     * )
     * @Assert\Email(message="Invalid Email address.")
     */
    protected $email;
    
    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\NotNull(message="Message Required.")
     */
    protected $content;
    
    /**
     * @ORM\Column(type="datetime")
     */
    protected $created_at;

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
     * Set name
     *
     * @param string $name
     * @return Message
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
     * Set email
     *
     * @param string $email
     * @return Message
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Message
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
     * @return Message
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
}
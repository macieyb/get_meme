<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        $this->setDescription("Difoltowy opis usera :)");
        $this->setAvatarPath("Difoltowy path avatar");
        $this->setBackgroundPath("Difolotowy path background");
        $this->setRegisteredAt(new \DateTime("now"));
        $this->posts = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    /**
     * One User has Many Posts.
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Post", mappedBy="user")
     */
    private $posts;

    /**
     * One User has Many Comments.
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Comment", mappedBy="user")
     */
    private $comments;

    /**
     * @ORM\Column(type="string", name="description")
     * @Assert\Length(max="255")
     */
    private $description;

    /**
     * @ORM\Column(type="string", name="avatar_path")
     * @Assert\Length(max="50")
     */
    private $avatarPath;

    /**
     * @ORM\Column(type="string", name="background_path")
     * @Assert\Length(max="50")
     */
    private $backgroundPath;

    /**
     * @ORM\Column(type="datetime", name="registered_at")
     */
    private $registeredAt;

    /**
     * @return mixed
     */
    public function getAvatarPath()
    {
        return $this->avatarPath;
    }

    /**
     * @param mixed $avatarPath
     */
    public function setAvatarPath($avatarPath)
    {
        $this->avatarPath = $avatarPath;
    }

    /**
     * @return mixed
     */
    public function getBackgroundPath()
    {
        return $this->backgroundPath;
    }

    /**
     * @param mixed $backgroundPath
     */
    public function setBackgroundPath($backgroundPath)
    {
        $this->backgroundPath = $backgroundPath;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getRegisteredAt()
    {
        return $this->registeredAt;
    }

    /**
     * @param mixed $registeredAt
     */
    public function setRegisteredAt($registeredAt)
    {
        $this->registeredAt = $registeredAt;
    }


    /**
     * Add posts
     *
     * @param \AppBundle\Entity\Post $posts
     * @return User
     */
    public function addPost(\AppBundle\Entity\Post $posts)
    {
        $this->posts[] = $posts;

        return $this;
    }

    /**
     * Remove posts
     *
     * @param \AppBundle\Entity\Post $posts
     */
    public function removePost(\AppBundle\Entity\Post $posts)
    {
        $this->posts->removeElement($posts);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * Add comments
     *
     * @param \AppBundle\Entity\Comment $comments
     * @return User
     */
    public function addComment(\AppBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \AppBundle\Entity\Comment $comments
     */
    public function removeComment(\AppBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }
}

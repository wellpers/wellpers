<?php

namespace Wellpers\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="Wellpers\UserBundle\Repository\UserRepository")
 */
class User extends BaseUser {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $firstname
     *
     * @ORM\Column(name="firstname", type="string", length=255, nullable=true)
     */
    private $firstname;

    /**
     * @var string $lastname
     *
     * @ORM\Column(name="lastname", type="string", length=255, nullable=true)
     */
    private $lastname;

    public function __construct() {
        parent::__construct();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Gets the value of firstname.
     *
     * @return string $firstname
     */
    public function getFirstname() {
        return $this->firstname;
    }

    /**
     * Sets the value of firstname.
     *
     * @param string $firstname the firstname
     *
     * @return self
     */
    public function setFirstname($firstname) {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * Gets the value of lastname.
     *
     * @return string $lastname
     */
    public function getLastname() {
        return $this->lastname;
    }

    /**
     * Sets the value of lastname.
     *
     * @param string $lastname the lastname
     *
     * @return self
     */
    public function setLastname($lastname) {
        $this->lastname = $lastname;
        return $this;
    }

}

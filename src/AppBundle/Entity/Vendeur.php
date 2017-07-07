<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vendeur
 *
 * @ORM\Table(name="vendeur")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VendeurRepository")
 */
class Vendeur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank(message="Le vendeur doit avoir un prénom")
     * @ORM\Column(name="firstName", type="string", length=20)
     */
    private $firstName;

    /**
     * @var string
     * @Assert\NotBlank(message="Le vendeur doit avoir un nom")
     * @ORM\Column(name="name", type="string", length=20)
     */
    private $name;

    /**
     * @var string
     * @Assert\Email(message="Cet email n'est pas valide")
     * @Assert\NotBlank(message="Le vendeur doit avoir un email")
     * @ORM\Column(name="email", type="string", length=30, unique=true)
     */
    private $email;

    /**
     * @var string
     * @Assert\NotBlank(message="Le vendeur doit avoir un mot de passe")
     * @ORM\Column(name="password", type="string", length=20)
     */
    private $password;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Vendeur
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Vendeur
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
     *
     * @return Vendeur
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
     * Set password
     *
     * @param string $password
     *
     * @return Vendeur
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
}

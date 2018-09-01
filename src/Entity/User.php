<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use FOS\UserBundle\Model\User as BaseUser;


/**
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

//    /**
//     * @ORM\Column(type="string", length=25, unique=true)
//     * @Assert\NotBlank()
//     */
//    private $username;
//
//    /**
//     * @ORM\Column(type="string", length=64)
//     */
//    private $password;
//
//    /**
//     * @var string
//     * @Assert\NotBlank()
//     * @Assert\Length(max=4096)
//     */
//    private $plainPassword;
//
//    /**
//     * @ORM\Column(type="string", length=254, unique=true)
//     * @Assert\NotBlank()
//     * @Assert\Email()
//     */
//    private $email;
//
//    /**
//     * @ORM\Column(type="array")
//     */
//    private $roles;
//
//    /**
//     * @ORM\Column(name="is_active", type="boolean")
//     */
//    private $isActive;

    public function __construct()
    {
        parent::__construct();
        $this->roles[] = 'ROLE_USER';
    }

//    /**
//     * @param string $username
//     */
//    public function setUsername(string $username)
//    {
//        $this->username = $username;
//    }
//
//    /**
//     * @return string
//     */
//    public function getUsername()
//    {
//        return $this->username;
//    }
//
//    /**
//     * @param string $password
//     */
//    public function setPassword(string $password)
//    {
//        $this->password = $password;
//    }
//
//    /**
//     * @return string
//     */
//    public function getPassword()
//    {
//        return $this->password;
//    }
//
//    /**
//     * @param $plainPassword
//     */
//    public function setPlainPassword($plainPassword)
//    {
//        $this->plainPassword = $plainPassword;
//    }
//
//    /**
//     * @return string
//     */
//    public function getPlainPassword()
//    {
//        return $this->plainPassword;
//    }
//
//    /**
//     * @param string $email
//     */
//    public function setEmail(string $email)
//    {
//        $this->email = $email;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getEmail()
//    {
//        return $this->email;
//    }
//
//    /**
//     * @param string $role
//     */
//    public function addRole(string $role)
//    {
//        $this->roles[] = $role;
//    }
//
//    /**
//     * @param array $roles
//     */
//    public function setRoles(array $roles)
//    {
//        $this->roles = $roles;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getRoles()
//    {
//        return $this->roles;
//    }
//
//    /**
//     * @return null|string
//     */
//    public function getSalt()
//    {
//        return null;
//    }
//
//    public function eraseCredentials()
//    {
//    }
//
//    public function serialize()
//    {
//        return serialize([
//            $this->id,
//            $this->username,
//        ]);
//    }
//
//    public function unserialize($serialized)
//    {
//        list (
//            $this->id,
//            $this->username,
//            ) = unserialize($serialized, array('allowed_classes' => false));
//    }
}
<?php
namespace App\Entity;

use App\Controller\UserRegister;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Table(name="`user`")
 * @ORM\Entity
 * @UniqueEntity(fields="email", message="Email already taken")
 * @UniqueEntity(fields="username", message="Username already taken")
 * @ApiResource(
 *     normalizationContext={"groups"={"user", "user:read"}},
 *     denormalizationContext={"groups"={"user", "user:write"}},
 *     collectionOperations={
 *         "get",
 *         "register"={
 *             "method"="POST",
 *             "path"="/user",
 *             "controller"=UserRegister::class
 *         },
 *         "login"={
 *             "route_name"="login_check",
 *             "method"="POST",
 *             "swagger_context"={
 *                 "parameters"={
 *                     {
 *                         "name"="json",
 *                         "in"="body",
 *                         "required"="false",
 *                         "type"="string"
 *                     }
 *                 },
 *                 "summary" = "Creates a token for authentiaction",
 *                 "consumes" = {
 *                      "application/json"
 *                 },
 *                 "produces" = {
 *                      "application/json"
 *                  }
 *             }
 *         }
 *     }
 * )
 */
class User implements UserInterface, \Serializable
{
    /**
     * @var int The id of this user.
     * 
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string The username.
     * 
     * @Assert\NotBlank()
     * @Groups({"user"})
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $username;

    /**
     * @var string The password hash.
     * 
     * @ORM\Column(type="string", length=256)
     */
    private $password;

    /**
     * @var string The plain password to hash.
     * 
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     * @Groups({"user:write"})
     */
    private $plainPassword;

    /**
     * @var string The user's email.
     * 
     * @Assert\NotBlank()
     * @Assert\Email()
     * @Groups({"user"})
     * @ORM\Column(type="string", length=256, unique=true)
     */
    private $email;

    /**
     * @var bool User permissions status. True if user is an admin.
     * 
     * @Groups({"user:read"})
     * @ORM\Column(type="boolean")
     */
    private $admin;

    public function __construct()
    {
        $this->admin = false;
    }

    /**
	 * Get the id of this user.
	 *
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
	}

    /**
	 * Get the username.
	 *
	 * @return string
	 */
	public function getUsername(): string
	{
		return $this->username;
	}

	/**
	 * Set the username.
	 *
	 * @param string $username The username.
	 *
	 * @return self
	 */
	public function setUsername(string $username)
	{
		$this->username = $username;

		return $this;
    }
    
    /**
	 * Get the password hash.
	 *
	 * @return string
	 */
	public function getPassword(): string
	{
		return $this->password;
	}

	/**
	 * Set the password hash.
	 *
	 * @param string $password The password hash.
	 *
	 * @return self
	 */
	public function setPassword(string $password)
	{
		$this->password = $password;

		return $this;
    }
    
    /**
	 * Get the plain password to hash.
	 *
	 * @return string
	 */
	public function getPlainPassword(): string
	{
		return $this->plainPassword;
	}

	/**
	 * Set the plain password to hash.
	 *
	 * @param string $plainPassword The plain password to hash.
	 *
	 * @return self
	 */
	public function setPlainPassword(string $plainPassword)
	{
		$this->plainPassword = $plainPassword;

		return $this;
	}

    /**
	 * Get the user's email.
	 *
	 * @return string
	 */
	public function getEmail(): string
	{
		return $this->email;
	}

	/**
	 * Set the user's email.
	 *
	 * @param string $email The user's email.
	 *
	 * @return self
	 */
	public function setEmail(string $email)
	{
		$this->email = $email;

		return $this;
    }
    
    /**
	 * Get user permissions status. True if user is an admin.
	 *
	 * @return bool
	 */
	public function getAdmin(): bool
	{
		return $this->admin;
	}

	/**
	 * Set user permissions status. True if user is an admin.
	 *
	 * @param bool $admin User permissions status. True if user is an admin.
	 *
	 * @return self
	 */
	public function setAdmin(bool $admin)
	{
		$this->admin = $admin;

		return $this;
	}
    
    public function getSalt()
    {
        return null;
    }

    public function getRoles()
    {
        return $this->admin ? array('ROLE_ADMIN') : array('ROLE_USER');
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
        ) = unserialize($serialized, array('allowed_classes' => false));
    }
}
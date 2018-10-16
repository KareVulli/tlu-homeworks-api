<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Table(name="`user`")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ApiResource(
 *     normalizationContext={"groups"={"user", "user:read"}},
 *     denormalizationContext={"groups"={"user", "user:write"}}
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
     * @Groups({"user:write"})
     */
    private $plainPassword;

    /**
     * @var string The user's email.
     * 
     * @Groups({"user"})
     * @ORM\Column(type="string", length=256, unique=true)
     */
    private $email;

    /**
     * @var bool User permissions status. True if user is an admin.
     * 
     * @ORM\Column(type="boolean")
     */
    private $admin;

    public function __construct()
    {
        $this->isActive = true;
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
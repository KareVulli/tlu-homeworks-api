<?php
namespace App\Entity\Traits;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

trait OwnerTrait
{
    /**
     * @var User The owner of the resource.
     *
     * @ORM\ManyToOne(targetEntity="User")
     */
    public $owner;

	/**
	 * Get the owner of the resource.
	 *
	 * @return User
	 */
	public function getOwner(): User
	{
		return $this->owner;
	}

	/**
	 * Set the owner of the resource.
	 *
	 * @param User $owner The owner of the resource.
	 *
	 * @return self
	 */
	public function setOwner(User $owner)
	{
		$this->owner = $owner;

		return $this;
	}
}
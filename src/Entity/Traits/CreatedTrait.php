<?php
namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;

trait CreatedTrait
{
    /**
     * @var \DateTimeInterface Timestamp of when the resource was created.
     *
     * @Gedmo\Timestampable(on="create")
	 * @Groups({"created"})
     * @ORM\Column(type="datetime")
     */
    public $created;

    /**
     * @var \DateTimeInterface Timestamp of when the resource was updated.
     *
     * @Gedmo\Timestampable
	 * @Groups({"created"})
     * @ORM\Column(type="datetime")
     */
    private $updated;

	/**
	 * Get timestamp of when the resource was created.
	 *
	 * @return \DateTimeInterface
	 */
	public function getCreated(): \DateTimeInterface
	{
		return $this->created;
	}

	/**
	 * Set timestamp of when the resource was created.
	 *
	 * @param \DateTimeInterface $created Timestamp of when the resource was created.
	 *
	 * @return self
	 */
	public function setCreated(\DateTimeInterface $created)
	{
		$this->created = $created;

		return $this;
	}

	/**
	 * Get timestamp of when the resource was updated.
	 *
	 * @return \DateTimeInterface
	 */
	public function getUpdated(): \DateTimeInterface
	{
		return $this->updated;
	}

	/**
	 * Set timestamp of when the resource was updated.
	 *
	 * @param \DateTimeInterface $updated Timestamp of when the resource was updated.
	 *
	 * @return self
	 */
	public function setUpdated(\DateTimeInterface $updated)
	{
		$this->updated = $updated;

		return $this;
	}
}
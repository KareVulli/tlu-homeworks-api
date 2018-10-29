<?php
namespace App\Entity;

use App\Entity\Task;
use App\Entity\User;
use App\Annotation\UserAware;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\CreatedTrait;
use Gedmo\Mapping\Annotation as Gedmo;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * A link between a user and a task that the user completed.
 *
 * @ApiResource(
 * 		normalizationContext={"groups"={"read"}},
 *     	denormalizationContext={"groups"={"write"}},
 * 		attributes={"access_control"="is_granted('ROLE_USER')"},
 * 		collectionOperations={
 *         	"get",
 *         	"post"
 *     	},
 *     	itemOperations={
 * 			"get"={"access_control"="is_granted('ROLE_ADMIN') or (is_granted('ROLE_USER') and object.user == user)"},
 * 			"delete"={"access_control"="is_granted('ROLE_ADMIN') or (is_granted('ROLE_USER') and object.user == user)"}
 *     	}
 * )
 * @ORM\Entity
 * @UserAware(userField="user_id")
 */
class UserDoneTask
{
	use CreatedTrait;

    /**
     * @var int The id of this task.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
	 * @Groups("read")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var User The user that complethed a task.
     *
	 * @Groups("read")
	 * @Gedmo\Blameable(on="create")
     * @ORM\ManyToOne(targetEntity="User")
     */
    public $user;

    /**
     * @var Task The task a user completed.
     *
	 * @Assert\NotNull
	 * @Groups({"read", "write"})
	 * @ApiSubresource
     * @ORM\ManyToOne(targetEntity="Task")
     */
    public $task;

    public function getId(): ?int
    {
        return $this->id;
	}
	
	/**
	 * Get the user that complethed a task.
	 *
	 * @return User
	 */
	public function getUser(): User
	{
		return $this->user;
	}

	/**
	 * Set the user that complethed a task.
	 *
	 * @param User $user The user that complethed a task.
	 *
	 * @return self
	 */
	public function setUser(User $user)
	{
		$this->user = $user;

		return $this;
	}

	/**
	 * Get the task a user completed.
	 *
	 * @return Task
	 */
	public function getTask(): Task
	{
		return $this->task;
	}

	/**
	 * Set the task a user completed.
	 *
	 * @param Task $task The task a user completed.
	 *
	 * @return self
	 */
	public function setTask(Task $task)
	{
		$this->task = $task;

		return $this;
	}
}
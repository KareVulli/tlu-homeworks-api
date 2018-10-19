<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A study group / class.
 *
 * @ApiResource(
 * 		attributes={"access_control"="is_granted('ROLE_USER')"},
 * 		collectionOperations={
 *         	"get",
 *         	"post"={"access_control"="is_granted('ROLE_ADMIN')"}
 *     	},
 *     	itemOperations={
 * 			"get",
 *         	"put"={"access_control"="is_granted('ROLE_ADMIN')"},
 * 			"delete"={"access_control"="is_granted('ROLE_ADMIN')"},
 *     	}
 * )
 * @ORM\Entity()
 * @ORM\Table(name="`group`")
 */
class Group
{
    /**
     * @var int The id of this group.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string The group's code.
     *
	 * @Assert\NotBlank
     * @ORM\Column
     */
    private $code;

    /**
     * @var string The name of the group.
     *
	 * @Assert\NotBlank
     * @ORM\Column
     */
    private $name;

    /**
     * @var Lesson[] All lessons for this group.
     *
     * @ORM\ManyToMany(targetEntity="Lesson", inversedBy="groups")
     * @ORM\JoinTable(name="groups_lessons")
     */
    public $lessons;
    
    public function __construct() {
        $this->tasks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    
	/**
	 * Get the group's code.
	 *
	 * @return string
	 */
	public function getCode(): string
	{
		return $this->code;
	}

	/**
	 * Set the group's code.
	 *
	 * @param string $code The group's code.
	 *
	 * @return self
	 */
	public function setCode(string $code)
	{
		$this->code = $code;

		return $this;
	}

	/**
	 * Get the name of the group.
	 *
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}

	/**
	 * Set the name of the group.
	 *
	 * @param string $name The name of the group.
	 *
	 * @return self
	 */
	public function setName(string $name)
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * Get all lessons for this group.
	 *
	 * @return Lesson[]
	 */
	public function getLessons()
	{
		return $this->lessons;
	}

	/**
	 * Set all lessons for this group.
	 *
	 * @param Lesson[] $lessons All lessons for this group.
	 *
	 * @return self
	 */
	public function setLessons($lessons)
	{
		$this->lessons = $lessons;

		return $this;
	}
}
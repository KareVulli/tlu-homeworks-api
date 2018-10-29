<?php
namespace App\Entity;

use App\Entity\Lesson;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\CreatedTrait;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * A single homework task.
 *
 * @ApiResource(
 * 		denormalizationContext={"groups"={"write"}},
 * 		attributes={"access_control"="is_granted('ROLE_USER')", "force_eager"=false},
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
 * @ApiFilter(SearchFilter::class, properties={"lesson.groups": "exact", "lesson": "exact"})
 * @ORM\Entity
 */
class Task
{
	use CreatedTrait;
	
    /**
     * @var int The id of this task.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string The title of the task.
     *
	 * @Assert\NotBlank
     * @ORM\Column
	 * @Groups({"write"})
     */
    private $title;

    /**
     * @var string The description of the task.
     *
	 * @Assert\NotBlank
     * @ORM\Column(type="text")
	 * @Groups({"write"})
     */
    public $description;

    /**
     * @var \DateTimeInterface The deadline for this task.
     *
	 * @Assert\NotNull
     * @ORM\Column(type="datetime")
	 * @Groups({"write"})
     */
    public $deadline;

    /**
     * @var Lesson The lesson this task is from.
     *
	 * @Assert\NotNull
     * @ORM\ManyToOne(targetEntity="Lesson", inversedBy="tasks")
	 * @Groups({"write"})
     */
    public $lesson;

    public function getId(): ?int
    {
        return $this->id;
    }

	/**
	 * Get the title of the task.
	 *
	 * @return string
	 */
	public function getTitle(): string
	{
		return $this->title;
	}

	/**
	 * Set the title of the task.
	 *
	 * @param string $title The title of the task.
	 *
	 * @return self
	 */
	public function setTitle(string $title)
	{
		$this->title = $title;

		return $this;
	}

	/**
	 * Get the description of the task.
	 *
	 * @return string
	 */
	public function getDescription(): string
	{
		return $this->description;
	}

	/**
	 * Set the description of the task.
	 *
	 * @param string $description The description of the task.
	 *
	 * @return self
	 */
	public function setDescription(string $description)
	{
		$this->description = $description;

		return $this;
	}

	/**
	 * Get the deadline for this task.
	 *
	 * @return \DateTimeInterface
	 */
	public function getDeadline(): \DateTimeInterface
	{
		return $this->deadline;
	}

	/**
	 * Set the deadline for this task.
	 *
	 * @param \DateTimeInterface $deadline The deadline for this task.
	 *
	 * @return self
	 */
	public function setDeadline(\DateTimeInterface $deadline)
	{
		$this->deadline = $deadline;

		return $this;
	}

	/**
	 * Get the lesson this task is from.
	 *
	 * @return Lesson
	 */
	public function getLesson(): Lesson
	{
		return $this->lesson;
	}

	/**
	 * Set the lesson this task is from.
	 *
	 * @param Lesson $lesson The lesson this task is from.
	 *
	 * @return self
	 */
	public function setLesson(Lesson $lesson)
	{
		$this->lesson = $lesson;

		return $this;
	}
}
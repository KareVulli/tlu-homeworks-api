<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A lesson.
 *
 * @ApiResource
 * @ORM\Entity
 */
class Lesson
{
    /**
     * @var int The id of this lesson.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string The lesson's code.
     *
	 * @Assert\NotBlank
     * @ORM\Column
     */
    private $code;

    /**
     * @var string The name of the lesson.
     *
	 * @Assert\NotBlank
     * @ORM\Column
     */
    private $name;

    /**
     * @var string The description of the lesson.
     *
	 * @Assert\NotBlank
     * @ORM\Column(type="text")
     */
    public $description;

    /**
     * @var string The teacher for this lesson.
     *
	 * @Assert\NotBlank
     * @ORM\Column
     */
    public $teacher;

    /**
     * @var Task[] All tasks for this lesson.
     *
     * @ORM\OneToMany(targetEntity="Task", mappedBy="lesson")
     */
    public $tasks;
    
    public function __construct() {
        $this->tasks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

	/**
	 * Get the lesson's code.
	 *
	 * @return string
	 */
	public function getCode(): string
	{
		return $this->code;
	}

	/**
	 * Set the lesson's code.
	 *
	 * @param string $code The lesson's code.
	 *
	 * @return self
	 */
	public function setCode(string $code)
	{
		$this->code = $code;

		return $this;
	}

	/**
	 * Get the name of the lesson.
	 *
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}

	/**
	 * Set the name of the lesson.
	 *
	 * @param string $name The name of the lesson.
	 *
	 * @return self
	 */
	public function setName(string $name)
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * Get the description of the lesson.
	 *
	 * @return string
	 */
	public function getDescription(): string
	{
		return $this->description;
	}

	/**
	 * Set the description of the lesson.
	 *
	 * @param string $description The description of the lesson.
	 *
	 * @return self
	 */
	public function setDescription(string $description)
	{
		$this->description = $description;

		return $this;
	}

	/**
	 * Get the teacher for this lesson.
	 *
	 * @return string
	 */
	public function getTeacher(): string
	{
		return $this->teacher;
	}

	/**
	 * Set the teacher for this lesson.
	 *
	 * @param string $teacher The teacher for this lesson.
	 *
	 * @return self
	 */
	public function setTeacher(string $teacher)
	{
		$this->teacher = $teacher;

		return $this;
	}

	/**
	 * Get all tasks for this lesson.
	 *
	 * @return Task[]
	 */
	public function getTasks()
	{
		return $this->tasks;
	}

	/**
	 * Set all tasks for this lesson.
	 *
	 * @param Task[] $tasks All tasks for this lesson.
	 *
	 * @return self
	 */
	public function setTasks($tasks)
	{
		$this->tasks = $tasks;

		return $this;
	}
}
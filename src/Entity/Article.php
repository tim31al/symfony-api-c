<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;
use DateTime;
use Swagger\Annotations as SWG;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 * @ORM\Table(name="articles")
 */
class Article
{
    public function __construct()
    {
        $this->createdAt = new DateTime('now');
    }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @SWG\Property(description="The unique identifier of the article.")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @SWG\Property(type="string", maxLength=255)
     */
    private string $title;

    /**
     * @ORM\Column(type="text")
     *
     * @SWG\Property(type="string")
     */
    private string $body;

    /**
     * @ORM\Column(type="datetime")
     *
     * @SWG\Property(type="string", format="date-time")
     */
    private DateTime $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'body' => $this->getBody(),
            'createdAt' => $this->getCreatedAt()->format(\DATE_ATOM),
        ];
    }

}

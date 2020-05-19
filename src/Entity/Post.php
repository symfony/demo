<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Entity;

use Doctrine\Common;
use Doctrine\ORM;
use Symfony\Bridge\Doctrine;
use Symfony\Component\Validator;

/**
 * @ORM\Mapping\Entity(repositoryClass="App\Repository\PostRepository")
 * @ORM\Mapping\Table(name="symfony_demo_post")
 * @Doctrine\Validator\Constraints\UniqueEntity(fields={"slug"}, errorPath="title", message="post.slug_unique")
 *
 * Defines the properties of the Post entity to represent the blog posts.
 *
 * See https://symfony.com/doc/current/doctrine.html#creating-an-entity-class
 *
 * Tip: if you have an existing database, you can generate these entity class automatically.
 * See https://symfony.com/doc/current/doctrine/reverse_engineering.html
 *
 * @author Ryan Weaver <weaverryan@gmail.com>
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 * @author Yonel Ceruto <yonelceruto@gmail.com>
 */
class Post
{
    /**
     * Use constants to define configuration options that rarely change instead
     * of specifying them under parameters section in config/services.yaml file.
     *
     * See https://symfony.com/doc/current/best_practices.html#use-constants-to-define-options-that-rarely-change
     */
    public const NUM_ITEMS = 10;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Mapping\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Mapping\Column(type="string")
     * @Validator\Constraints\NotBlank()
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Mapping\Column(type="string")
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Mapping\Column(type="string")
     * @Validator\Constraints\NotBlank(message="post.blank_summary")
     * @Validator\Constraints\Length(max=255)
     */
    private $summary;

    /**
     * @var string
     *
     * @ORM\Mapping\Column(type="text")
     * @Validator\Constraints\NotBlank(message="post.blank_content")
     * @Validator\Constraints\Length(min=10, minMessage="post.too_short_content")
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Mapping\Column(type="datetime")
     */
    private $publishedAt;

    /**
     * @var User
     *
     * @ORM\Mapping\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\Mapping\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * @var Comment[]|Common\Collections\ArrayCollection
     *
     * @ORM\Mapping\OneToMany(
     *      targetEntity="Comment",
     *      mappedBy="post",
     *      orphanRemoval=true,
     *      cascade={"persist"}
     * )
     * @ORM\Mapping\OrderBy({"publishedAt": "DESC"})
     */
    private $comments;

    /**
     * @var Tag[]|Common\Collections\ArrayCollection
     *
     * @ORM\Mapping\ManyToMany(targetEntity="App\Entity\Tag", cascade={"persist"})
     * @ORM\Mapping\JoinTable(name="symfony_demo_post_tag")
     * @ORM\Mapping\OrderBy({"name": "ASC"})
     * @Validator\Constraints\Count(max="4", maxMessage="post.too_many_tags")
     */
    private $tags;

    public function __construct()
    {
        $this->publishedAt = new \DateTime();
        $this->comments = new Common\Collections\ArrayCollection();
        $this->tags = new Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getPublishedAt(): \DateTime
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(\DateTime $publishedAt): void
    {
        $this->publishedAt = $publishedAt;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(User $author): void
    {
        $this->author = $author;
    }

    public function getComments(): Common\Collections\Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): void
    {
        $comment->setPost($this);
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
        }
    }

    public function removeComment(Comment $comment): void
    {
        $this->comments->removeElement($comment);
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): void
    {
        $this->summary = $summary;
    }

    public function addTag(Tag ...$tags): void
    {
        foreach ($tags as $tag) {
            if (!$this->tags->contains($tag)) {
                $this->tags->add($tag);
            }
        }
    }

    public function removeTag(Tag $tag): void
    {
        $this->tags->removeElement($tag);
    }

    public function getTags(): Common\Collections\Collection
    {
        return $this->tags;
    }
}

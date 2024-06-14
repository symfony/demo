<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Form\Model;

use App\Entity\Post;
use App\Entity\Tag;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[UniqueEntity(fields: ['slug'], message: 'post.slug_unique', entityClass: Post::class, errorPath: 'title', identifierFieldNames: ['id'])]
final class PostDto
{
    public ?int $id = null;

    #[Assert\NotBlank]
    public string $title;

    public string $slug = '';

    #[Assert\NotBlank(message: 'post.blank_summary')]
    #[Assert\Length(max: 255)]
    public string $summary;

    #[Assert\NotBlank(message: 'post.blank_content')]
    #[Assert\Length(min: 10, minMessage: 'post.too_short_content')]
    public string $content;

    public \DateTimeImmutable $publishedAt;

    /**
     * @var Collection<int, Tag>
     */
    #[Assert\Count(max: 4, maxMessage: 'post.too_many_tags')]
    public Collection $tags;

    public static function from(Post $post): self
    {
        $dto = new self();
        $dto->id = $post->getId();
        $dto->title = $post->getTitle();
        $dto->slug = $post->getSlug();
        $dto->summary = $post->getSummary();
        $dto->content = $post->getContent();
        $dto->publishedAt = $post->getPublishedAt();
        $dto->tags = $post->getTags();

        return $dto;
    }

    public function to(Post $post): Post
    {
        $post->setTitle($this->title);
        $post->setSlug($this->slug);
        $post->setSummary($this->summary);
        $post->setContent($this->content);
        $post->setPublishedAt($this->publishedAt);
        $post->setTags($this->tags);

        return $post;
    }

    public function __construct()
    {
        $this->publishedAt = new \DateTimeImmutable();
        $this->tags = new ArrayCollection();
    }
}

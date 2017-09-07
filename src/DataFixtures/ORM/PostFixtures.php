<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\DataFixtures\ORM;

use App\DataFixtures\FixturesTrait;
use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\User;
use App\Utils\Slugger;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Defines the sample blog posts to load in the database before running the unit
 * and functional tests. Execute this command to load the data.
 *
 *   $ php bin/console doctrine:fixtures:load
 *
 * See https://symfony.com/doc/current/bundles/DoctrineFixturesBundle/index.html
 *
 * @author Ryan Weaver <weaverryan@gmail.com>
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 * @author Yonel Ceruto <yonelceruto@gmail.com>
 */
class PostFixtures extends AbstractFixture implements DependentFixtureInterface
{
    use FixturesTrait;

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager): void
    {
        foreach ($this->getRandomPostTitles() as $i => $title) {
            $post = new Post();

            $post->setTitle($title);
            $post->setSummary($this->getRandomPostSummary());
            $post->setSlug(Slugger::slugify($post->getTitle()));
            $post->setContent($this->getPostContent());
            $post->setPublishedAt(new \DateTime('now - '.$i.'days'));

            // Ensure that the first post is written by Jane Doe to simplify tests
            // "References" are the way to share objects between fixtures defined
            // in different files. This reference has been added in the UserFixtures
            // file and it contains an instance of the User entity.
            $post->setAuthor(0 === $i ? $this->getReference('jane-admin') : $this->getRandomUser());

            // for aesthetic reasons, the first blog post always has 2 tags
            foreach ($this->getRandomTags($i > 0 ? mt_rand(0, 3) : 2) as $tag) {
                $post->addTag($tag);
            }

            foreach (range(1, 5) as $j) {
                $comment = new Comment();

                $comment->setAuthor($this->getReference('john-user'));
                $comment->setPublishedAt(new \DateTime('now + '.($i + $j).'seconds'));
                $comment->setContent($this->getRandomCommentContent());

                $post->addComment($comment);

                $manager->persist($comment);
            }

            $manager->persist($post);
        }

        $manager->flush();
    }

    /**
     * Instead of defining the exact order in which the fixtures files must be loaded,
     * this method defines which other fixtures this file depends on. Then, Doctrine
     * will figure out the best order to fit all the dependencies.
     */
    public function getDependencies(): array
    {
        return [
            TagFixtures::class,
            UserFixtures::class,
        ];
    }

    private function getRandomUser(): User
    {
        $admins = ['jane-admin', 'tom-admin'];
        $index = array_rand($admins);

        return $this->getReference($admins[$index]);
    }

    private function getRandomTags(int $numTags = 0): array
    {
        $tags = [];

        if (0 === $numTags) {
            return $tags;
        }

        $indexes = (array) array_rand($this->getTagNames(), $numTags);
        foreach ($indexes as $index) {
            $tags[] = $this->getReference('tag-'.$index);
        }

        return $tags;
    }
}

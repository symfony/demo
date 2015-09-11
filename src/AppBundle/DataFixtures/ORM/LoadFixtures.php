<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Tag;
use AppBundle\Entity\User;
use AppBundle\Entity\Post;
use AppBundle\Entity\Comment;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Defines the sample data to load in the database when running the unit and
 * functional tests. Execute this command to load the data:
 *
 *   $ php app/console doctrine:fixtures:load
 *
 * See http://symfony.com/doc/current/bundles/DoctrineFixturesBundle/index.html
 *
 * @author Ryan Weaver <weaverryan@gmail.com>
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 * @author Rasanga Perera <rasangaperera@gmail.com>
 */
class LoadFixtures extends AbstractFixture implements FixtureInterface, ContainerAwareInterface
{
    /** @var ContainerInterface */
    private $container;

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->loadUsers($manager);
        $this->loadPosts($manager);
        $this->loadTags($manager);
        $this->loadPostsTags($manager);
    }

    private function loadUsers(ObjectManager $manager)
    {
        $passwordEncoder = $this->container->get('security.password_encoder');

        $johnUser = new User();
        $johnUser->setUsername('john_user');
        $johnUser->setEmail('john_user@symfony.com');
        $encodedPassword = $passwordEncoder->encodePassword($johnUser, 'kitten');
        $johnUser->setPassword($encodedPassword);
        $manager->persist($johnUser);

        $annaAdmin = new User();
        $annaAdmin->setUsername('anna_admin');
        $annaAdmin->setEmail('anna_admin@symfony.com');
        $annaAdmin->setRoles(array('ROLE_ADMIN'));
        $encodedPassword = $passwordEncoder->encodePassword($annaAdmin, 'kitten');
        $annaAdmin->setPassword($encodedPassword);
        $manager->persist($annaAdmin);

        $manager->flush();
    }

    private function loadPosts(ObjectManager $manager)
    {
        foreach (range(1, 10) as $i) {
            $post = new Post();

            $post->setTitle($this->getRandomPostTitle());
            $post->setSummary($this->getRandomPostSummary());
            $post->setSlug($this->container->get('slugger')->slugify($post->getTitle()));
            $post->setContent($this->getPostContent());
            $post->setAuthorEmail('anna_admin@symfony.com');
            $post->setPublishedAt(new \DateTime('now - '.$i.'days'));

            foreach (range(1, 5) as $j) {
                $comment = new Comment();

                $comment->setAuthorEmail('john_user@symfony.com');
                $comment->setPublishedAt(new \DateTime('now + '.($i + $j).'seconds'));
                $comment->setContent($this->getRandomCommentContent());
                $comment->setPost($post);

                $manager->persist($comment);
                $post->addComment($comment);
            }

            $manager->persist($post);

            $this->addReference('post-' . $i, $post);
        }

        $manager->flush();
    }

    private function loadTags(ObjectManager $manager)
    {
        $tagNames = array(
            'Lorem',
            'ipsum',
            'consectetur',
            'adipiscing',
            'incididunt',
            'labore',
            'voluptate'
        );

        foreach ($tagNames as $key => $name) {
            $tag = new Tag();
            $tag->setName($name);

            $manager->persist($tag);

            $this->addReference('tag-' . ++$key, $tag);
        }

        $manager->flush();
    }

    private function loadPostsTags(ObjectManager $manager)
    {
        /** @var Post $post1 */
        $post1 = $this->getReference('post-1');
        /** @var Post $post2 */
        $post2 = $this->getReference('post-2');
        /** @var Post $post3 */
        $post3 = $this->getReference('post-3');
        /** @var Post $post4 */
        $post4 = $this->getReference('post-4');
        /** @var Post $post5 */
        $post5 = $this->getReference('post-5');
        /** @var Post $post6 */
        $post6 = $this->getReference('post-6');
        /** @var Post $post7 */
        $post7 = $this->getReference('post-7');
        /** @var Post $post8 */
        $post8 = $this->getReference('post-8');
        /** @var Post $post9 */
        $post9 = $this->getReference('post-9');
        /** @var Post $post10 */
        $post10 = $this->getReference('post-10');

        /** @var Tag $tag1 */
        $tag1 = $this->getReference('tag-1');
        /** @var Tag $tag2 */
        $tag2 = $this->getReference('tag-2');
        /** @var Tag $tag3 */
        $tag3 = $this->getReference('tag-3');
        /** @var Tag $tag4 */
        $tag4 = $this->getReference('tag-4');
        /** @var Tag $tag5 */
        $tag5 = $this->getReference('tag-5');
        /** @var Tag $tag6 */
        $tag6 = $this->getReference('tag-6');
        /** @var Tag $tag7 */
        $tag7 = $this->getReference('tag-7');

        $post1->addTag($tag1);
        $post1->addTag($tag3);
        $manager->persist($post1);

        $post2->addTag($tag2);
        $manager->persist($post2);

        $post3->addTag($tag3);
        $post3->addTag($tag4);
        $post3->addTag($tag5);
        $manager->persist($post3);

        $post4->addTag($tag6);
        $post4->addTag($tag7);
        $manager->persist($post4);

        $post5->addTag($tag1);
        $manager->persist($post5);

        $post6->addTag($tag1);
        $manager->persist($post6);

        $post7->addTag($tag3);
        $manager->persist($post7);

        $post8->addTag($tag5);
        $post8->addTag($tag7);
        $manager->persist($post8);

        $post9->addTag($tag1);
        $manager->persist($post9);

        $post10->addTag($tag4);
        $post10->addTag($tag6);
        $manager->persist($post10);

        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    private function getPostContent()
    {
        return <<<MARKDOWN
Lorem ipsum dolor sit amet consectetur adipisicing elit, sed do eiusmod tempor
incididunt ut labore et **dolore magna aliqua**: Duis aute irure dolor in
reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
deserunt mollit anim id est laborum.

  * Ut enim ad minim veniam
  * Quis nostrud exercitation *ullamco laboris*
  * Nisi ut aliquip ex ea commodo consequat

Praesent id fermentum lorem. Ut est lorem, fringilla at accumsan nec, euismod at
nunc. Aenean mattis sollicitudin mattis. Nullam pulvinar vestibulum bibendum.
Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos
himenaeos. Fusce nulla purus, gravida ac interdum ut, blandit eget ex. Duis a
luctus dolor.

Integer auctor massa maximus nulla scelerisque accumsan. *Aliquam ac malesuada*
ex. Pellentesque tortor magna, vulputate eu vulputate ut, venenatis ac lectus.
Praesent ut lacinia sem. Mauris a lectus eget felis mollis feugiat. Quisque
efficitur, mi ut semper pulvinar, urna urna blandit massa, eget tincidunt augue
nulla vitae est.

Ut posuere aliquet tincidunt. Aliquam erat volutpat. **Class aptent taciti**
sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi
arcu orci, gravida eget aliquam eu, suscipit et ante. Morbi vulputate metus vel
ipsum finibus, ut dapibus massa feugiat. Vestibulum vel lobortis libero. Sed
tincidunt tellus et viverra scelerisque. Pellentesque tincidunt cursus felis.
Sed in egestas erat.

Aliquam pulvinar interdum massa, vel ullamcorper ante consectetur eu. Vestibulum
lacinia ac enim vel placerat. Integer pulvinar magna nec dui malesuada, nec
congue nisl dictum. Donec mollis nisl tortor, at congue erat consequat a. Nam
tempus elit porta, blandit elit vel, viverra lorem. Sed sit amet tellus
tincidunt, faucibus nisl in, aliquet libero.
MARKDOWN;
    }

    private function getPhrases()
    {
        return array(
            'Lorem ipsum dolor sit amet consectetur adipiscing elit',
            'Pellentesque vitae velit ex',
            'Mauris dapibus risus quis suscipit vulputate',
            'Eros diam egestas libero eu vulputate risus',
            'In hac habitasse platea dictumst',
            'Morbi tempus commodo mattis',
            'Ut suscipit posuere justo at vulputate',
            'Ut eleifend mauris et risus ultrices egestas',
            'Aliquam sodales odio id eleifend tristique',
            'Urna nisl sollicitudin id varius orci quam id turpis',
            'Nulla porta lobortis ligula vel egestas',
            'Curabitur aliquam euismod dolor non ornare',
            'Sed varius a risus eget aliquam',
            'Nunc viverra elit ac laoreet suscipit',
            'Pellentesque et sapien pulvinar consectetur',
        );
    }

    private function getRandomPostTitle()
    {
        $titles = $this->getPhrases();

        return $titles[array_rand($titles)];
    }

    private function getRandomPostSummary()
    {
        $phrases = $this->getPhrases();

        $numPhrases = rand(6, 12);
        shuffle($phrases);

        return implode(' ', array_slice($phrases, 0, $numPhrases-1));
    }

    private function getRandomCommentContent()
    {
        $phrases = $this->getPhrases();

        $numPhrases = rand(2, 15);
        shuffle($phrases);

        return implode(' ', array_slice($phrases, 0, $numPhrases-1));
    }
}

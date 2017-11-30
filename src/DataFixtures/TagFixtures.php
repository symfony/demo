<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Defines the sample blog tags to load in the database before running the unit
 * and functional tests. Execute this command to load the data.
 *
 *   $ php bin/console doctrine:fixtures:load
 *
 * See https://symfony.com/doc/current/bundles/DoctrineFixturesBundle/index.html
 *
 * @author Yonel Ceruto <yonelceruto@gmail.com>
 */
class TagFixtures extends AbstractFixture
{
    use FixturesTrait;

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager): void
    {
        foreach ($this->getTagNames() as $index => $name) {
            $tag = new Tag();
            $tag->setName($name);

            $manager->persist($tag);
            $this->addReference('tag-'.$index, $tag);
        }

        $manager->flush();
    }
}

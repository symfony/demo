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
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Defines the sample blog tags to load in the database before running the unit
 * and functional tests. Execute this command to load the data.
 *
 *   $ php bin/console doctrine:fixtures:load
 *
 * See http://symfony.com/doc/current/bundles/DoctrineFixturesBundle/index.html
 *
 * @author Yonel Ceruto <yonelceruto@gmail.com>
 */
class TagFixtures extends AbstractFixture
{
    public static $names = [
        'lorem',
        'ipsum',
        'consectetur',
        'adipiscing',
        'incididunt',
        'labore',
        'voluptate',
        'dolore',
        'pariatur',
    ];

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        foreach (self::$names as $index => $name) {
            $tag = new Tag();
            $tag->setName($name);

            $manager->persist($tag);
            $this->addReference('tag-'.$index, $tag);
        }

        $manager->flush();
    }
}

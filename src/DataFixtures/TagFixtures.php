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
use Doctrine\Common\Persistence\ObjectManager;

class TagFixtures extends AppFixtures
{
    public function load(ObjectManager $manager): void
    {
        foreach ($this->getTagData() as $index => $name) {
            $tag = new Tag();
            $tag->setName($name);

            $manager->persist($tag);
            $this->addReference('tag-'.$name, $tag);
        }

        $manager->flush();
    }
}

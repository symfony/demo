<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Form\DataTransformer;

use AppBundle\Entity\Tag;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * This data transformer is used to translate the array of tags into a comma separated format
 * that can be displayed and managed by Bootstrap-tagsinput js plugin (and back on submit).
 *
 * See http://symfony.com/doc/current/form/data_transformers.html
 *
 * @author Yonel Ceruto <yonelceruto@gmail.com>
 */
class TagArrayToStringTransformer implements DataTransformerInterface
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * {@inheritdoc}
     */
    public function transform($array)
    {
        // This transformation expects an array of Tag always thanks to
        // Symfony\Bridge\Doctrine\Form\DataTransformer\CollectionToArrayTransformer::transform()
        // Just remains transform this array into a comma separated string format.

        /* @var Tag[] $array */
        return implode(',', $array);
    }

    /**
     * {@inheritdoc}
     */
    public function reverseTransform($string)
    {
        if ('' === $string || null === $string) {
            return [];
        }

        $names = explode(',', $string);

        // Now we need to get the current tags and to find the new ones that should be created.
        $tags = $this->manager->getRepository(Tag::class)->findBy([
            'name' => $names,
        ]);
        $newNames = array_diff($names, $tags);
        foreach ($newNames as $name) {
            $tag = new Tag();
            $tag->setName($name);
            $tags[] = $tag;

            // Don't worry about persisting these new tags, Doctrine is able to do it automatically
            // thanks to cascade={"persist"} configuration in AppBundle\Entity\Post::$tags property.
        }

        // This one should return an array always to transform these tags into Collection instance again.
        // See Symfony\Bridge\Doctrine\Form\DataTransformer\CollectionToArrayTransformer::reverseTransform()
        return $tags;
    }
}

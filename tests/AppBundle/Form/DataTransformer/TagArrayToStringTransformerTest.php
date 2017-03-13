<?php

namespace Tests\AppBundle\Form\DataTransformer;

use AppBundle\Entity\Tag;
use AppBundle\Form\DataTransformer\TagArrayToStringTransformer;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityRepository;

/**
 * Tests that tags are transformed correctly using the data transformer.
 *
 * See http://symfony.com/doc/current/testing/database.html
 *
 * @author Jonathan Boyer <contact@grafikart.fr>
 */
class TagArrayToStringTransformerTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Get a mocked instance of the TagArrayToStringTransformer.
     *
     * @return TagArrayToStringTransformer
     */
    public function getMockedTransformer($findByReturn = [])
    {
        $tagRepository = $this->getMockBuilder(EntityRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $tagRepository->expects($this->any())
            ->method('findBy')
            ->will($this->returnValue($findByReturn));

        $entityManager = $this
            ->getMockBuilder(ObjectManager::class)
            ->disableOriginalConstructor()
            ->getMock();
        $entityManager->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($tagRepository));

        return new TagArrayToStringTransformer($entityManager);
    }

    /**
     * Creates a new TagEntity instance.
     *
     * @param $name
     *
     * @return Tag
     */
    public function createTag($name)
    {
        $tag = new Tag();
        $tag->setName($name);

        return $tag;
    }

    /**
     * Ensures tags are created correctly.
     */
    public function testCreateTheRightAmountOfTags()
    {
        $tags = $this->getMockedTransformer()->reverseTransform('Hello, Demo, How');
        $this->assertCount(3, $tags);
        $this->assertSame('Hello', $tags[0]->getName());
    }

    /**
     * Too many commas.
     */
    public function testCreateTheRightAmountOfTagsWithTooManyCommas()
    {
        $transformer = $this->getMockedTransformer();
        $this->assertCount(3, $transformer->reverseTransform('Hello, Demo,, How'));
        $this->assertCount(3, $transformer->reverseTransform('Hello, Demo, How,'));
    }

    /**
     * Spaces at the end (and beginning) of a world shouldn't matter.
     */
    public function testTrimNames()
    {
        $tags = $this->getMockedTransformer()->reverseTransform('   Hello   ');
        $this->assertSame('Hello', $tags[0]->getName());
    }

    /**
     * Duplicate tags shouldn't create new entities.
     */
    public function testDuplicateNames()
    {
        $tags = $this->getMockedTransformer()->reverseTransform('Hello, Hello, Hello');
        $this->assertCount(1, $tags);
    }

    /**
     * This test ensure that the transformer uses tag already persisted in the Database.
     */
    public function testUsesAlreadyDefinedTags()
    {
        $persistedTags = [
            $this->createTag('Hello'),
            $this->createTag('World'),
        ];
        $tags = $this->getMockedTransformer($persistedTags)->reverseTransform('Hello, World, How, Are, You');
        $this->assertCount(5, $tags);
        $this->assertSame($persistedTags[0], $tags[0]);
        $this->assertSame($persistedTags[1], $tags[1]);
    }

    /**
     * Tags should be transformed into a string.
     */
    public function testTransform()
    {
        $persistedTags = [
            $this->createTag('Hello'),
            $this->createTag('World'),
        ];
        $transformed = $this->getMockedTransformer()->transform($persistedTags);
        $this->assertSame('Hello,World', $transformed);
    }
}

<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\Form\DataTransformer;

use App\Entity\Tag;
use App\Form\DataTransformer\TagArrayToStringTransformer;
use App\Repository\TagRepository;
use PHPUnit\Framework\TestCase;

/**
 * Tests that tags are transformed correctly using the data transformer.
 *
 * See https://symfony.com/doc/current/testing/database.html
 */
final class TagArrayToStringTransformerTest extends TestCase
{
    /**
     * Ensures that tags are created correctly.
     */
    public function testCreateTheRightAmountOfTags(): void
    {
        $tags = $this->getTestTransformer()->reverseTransform('Hello, Demo, How');

        $this->assertCount(3, $tags);
        $this->assertSame('Hello', $tags[0]->getName());
    }

    /**
     * Ensures that empty tags and errors in the number of commas are
     * dealt correctly.
     */
    public function testCreateTheRightAmountOfTagsWithTooManyCommas(): void
    {
        $transformer = $this->getTestTransformer();

        $this->assertCount(3, $transformer->reverseTransform('Hello, Demo,, How'));
        $this->assertCount(3, $transformer->reverseTransform('Hello, Demo, How,'));
    }

    /**
     * Ensures that leading/trailing spaces are ignored for tag names.
     */
    public function testTrimNames(): void
    {
        $tags = $this->getTestTransformer()->reverseTransform('   Hello   ');

        $this->assertSame('Hello', $tags[0]->getName());
    }

    /**
     * Ensures that duplicated tag names are ignored.
     */
    public function testDuplicateNames(): void
    {
        $tags = $this->getTestTransformer()->reverseTransform('Hello, Hello, Hello');

        $this->assertCount(1, $tags);
    }

    /**
     * Ensures that the transformer uses tags already persisted in the database.
     */
    public function testUsesAlreadyDefinedTags(): void
    {
        $persistedTags = [
            new Tag('Hello'),
            new Tag('World'),
        ];
        $tags = $this->getTestTransformer($persistedTags)->reverseTransform('Hello, World, How, Are, You');

        $this->assertCount(5, $tags);
        $this->assertSame($persistedTags[0], $tags[0]);
        $this->assertSame($persistedTags[1], $tags[1]);
    }

    /**
     * Ensures that the transformation from Tag instances to a simple string
     * works as expected.
     */
    public function testTransform(): void
    {
        $persistedTags = [
            new Tag('Hello'),
            new Tag('World'),
        ];
        $transformed = $this->getTestTransformer()->transform($persistedTags);

        $this->assertSame('Hello,World', $transformed);
    }

    /**
     * This helper method creates a test stub of the TagRepository class for
     * the TagArrayToStringTransformer class to simplify the tests.
     *
     * See https://docs.phpunit.de/en/12.5/test-doubles.html
     *
     * @param array<int, object> $findByReturnValues The values returned when calling to the findBy() method
     */
    private function getTestTransformer(array $findByReturnValues = []): TagArrayToStringTransformer
    {
        $tagRepository = $this->getStubBuilder(TagRepository::class)
            ->disableOriginalConstructor()
            ->getStub();

        $tagRepository
            ->method('findBy')
            ->willReturn($findByReturnValues);

        return new TagArrayToStringTransformer($tagRepository);
    }
}

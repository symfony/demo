<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests;

use App\Entity\Tag;
use PHPUnit\Framework\TestCase;

class TagTest extends TestCase
{
    private Tag $tag;

    protected function setUp(): void
    {
        parent::setUp();
        $this->tag = new Tag();
    }

    public function testGetName(): void
    {
        $name = 'lorem';
        $this->assertEmpty($this->tag->getName());
        $this->tag->setName($name);
        self::assertSame($name, $this->tag->getName());
    }
}

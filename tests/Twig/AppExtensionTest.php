<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Twig;

use App\Twig\AppExtension;
use PHPUnit\Framework\TestCase;

class AppExtensionTest extends TestCase
{
    public function testGetLocales(): void
    {
        $extension = new AppExtension(['ar', 'es', 'fr'], 'ar');

        $this->assertSame([
            ['code' => 'ar', 'name' => 'العربية'],
            ['code' => 'es', 'name' => 'español'],
            ['code' => 'fr', 'name' => 'français'],
        ], $extension->getLocales());
    }

    public function testIsRtl(): void
    {
        $extension = new AppExtension(['ar', 'es', 'fr'], 'ar');

        $this->assertFalse($extension->isRtl('fr'));
        $this->assertFalse($extension->isRtl('es'));
        $this->assertTrue($extension->isRtl('ar'));
        $this->assertTrue($extension->isRtl());
    }
}

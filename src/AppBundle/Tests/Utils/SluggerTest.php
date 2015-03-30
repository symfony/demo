<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Utils;

use AppBundle\Utils\Slugger;

/**
 * Unit test for the application utils.
 * See http://symfony.com/doc/current/book/testing.html#unit-tests
 *
 * Execute the application tests using this command (requires PHPUnit to be installed):
 *
 *     $ cd your-symfony-project/
 *     $ phpunit -c app
 *
 */
class SluggerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getSlugs
     */
    public function testSlugify($string, $slug)
    {
        $slugger = new Slugger();
        $result = $slugger->slugify($string);

        $this->assertEquals($slug, $result);
    }

    public function getSlugs()
    {
        return array(
            array('Lorem Ipsum'     , 'lorem-ipsum'),
            array('  Lorem Ipsum  ' , 'lorem-ipsum'),
            array(' lOrEm  iPsUm  ' , 'lorem-ipsum'),
            array('!Lorem Ipsum!'   , 'lorem-ipsum'),
            array('lorem-ipsum'     , 'lorem-ipsum'),
        );
    }
}

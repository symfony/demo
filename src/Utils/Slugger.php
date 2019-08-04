<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Utils;

/**
 * @author Ryan Weaver <weaverryan@gmail.com>
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 * @author Douglas Silva <doug.hs@protonmail.ch>
 * @author Josef Kufner <???>
 */
class Slugger
{
    public static function slugify(string $string): string
    {
        $slug = preg_replace('/[^a-z0-9-]+/', '-', mb_strtolower($string, 'UTF-8'));

        return trim($slug, '-');
    }
}

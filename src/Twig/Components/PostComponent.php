<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Twig\Components;

use App\Entity\Post;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * Twig component to display a Post.
 *
 * See https://symfony.com/bundles/ux-twig-component/current/index.html
 *
 * @author Romain Monteil <monteil.romain@gmail.com>
 */
#[AsTwigComponent(name: 'post')]
final class PostComponent
{
    public Post $post;
}

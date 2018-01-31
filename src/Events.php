<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App;

/**
 * This class defines the names of all the events dispatched in
 * the Symfony Demo application. It's not mandatory to create a
 * class like this, but it's considered a good practice.
 *
 * @author Oleg Voronkovich <oleg-voronkovich@yandex.ru>
 */
final class Events
{
    /**
     * For the event naming conventions, see:
     * https://symfony.com/doc/current/components/event_dispatcher.html#naming-conventions.
     *
     * @Event("Symfony\Component\EventDispatcher\GenericEvent")
     *
     * @var string
     */
    public const COMMENT_CREATED = 'comment.created';
}

<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle;

/**
 * Contains all events thrown in the Symfony demo application.
 *
 * @author Oleg Voronkovich <oleg-voronkovich@yandex.ru>
 */
final class Events
{
    /**
     * See http://symfony.com/doc/current/components/event_dispatcher.html#naming-conventions.
     *
     * @Event("Symfony\Component\EventDispatcher\GenericEvent")
     *
     * @var string
     */
    const COMMENT_CREATED = 'comment.created';
}

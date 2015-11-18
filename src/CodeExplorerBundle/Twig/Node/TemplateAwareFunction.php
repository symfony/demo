<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CodeExplorerBundle\Twig\Node;

/**
 * @author Oleg Voronkovich <oleg-voronkovich@yandex.ru>
 */
class TemplateAwareFunction extends \Twig_Node_Expression_Function
{
    /**
     * {@inheritdoc}
     */
    protected function compileArguments(\Twig_Compiler $compiler)
    {
        $compiler->raw('($this)');
    }
}

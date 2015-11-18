<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CodeExplorerBundle\Twig\NodeVisitor;

use CodeExplorerBundle\Twig\Node\TemplateVariable as TemplateVariableNode;

/**
 * @author Oleg Voronkovich <oleg-voronkovich@yandex.ru>
 */
class TemplateVariable extends \Twig_BaseNodeVisitor
{
    /**
     * @var string
     */
    private $variableName = '_tmpl';

    /**
     * {@inheritdoc}
     */
    protected function doEnterNode(\Twig_Node $node, \Twig_Environment $env)
    {
        if ($node instanceof \Twig_Node_Expression_Name && $this->variableName === $node->getAttribute('name')) {
            return new TemplateVariableNode();
        }

        return $node;
    }

    /**
     * {@inheritdoc}
     */
    protected function doLeaveNode(\Twig_Node $node, \Twig_Environment $env)
    {
        return $node;
    }

    /**
     * {@inheritdoc}
     */
    public function getPriority()
    {
        return 255;
    }
}

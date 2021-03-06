<?php

declare(strict_types=1);

namespace phpDocumentor\Guides\Renderers\LaTeX;

use phpDocumentor\Guides\Nodes\SeparatorNode;
use phpDocumentor\Guides\Renderer;
use phpDocumentor\Guides\Renderers\NodeRenderer;

class SeparatorNodeRenderer implements NodeRenderer
{
    /** @var Renderer */
    private $renderer;

    public function __construct(SeparatorNode $node)
    {
        $this->renderer = $node->getEnvironment()->getRenderer();
    }

    public function render() : string
    {
        return $this->renderer->render('separator.tex.twig');
    }
}

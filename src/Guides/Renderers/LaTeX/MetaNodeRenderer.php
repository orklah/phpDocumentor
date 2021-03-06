<?php

declare(strict_types=1);

namespace phpDocumentor\Guides\Renderers\LaTeX;

use phpDocumentor\Guides\Nodes\MetaNode;
use phpDocumentor\Guides\Renderer;
use phpDocumentor\Guides\Renderers\NodeRenderer;

class MetaNodeRenderer implements NodeRenderer
{
    /** @var MetaNode */
    private $metaNode;

    /** @var Renderer */
    private $renderer;

    public function __construct(MetaNode $metaNode)
    {
        $this->metaNode = $metaNode;
        $this->renderer = $metaNode->getEnvironment()->getRenderer();
    }

    public function render() : string
    {
        return $this->renderer->render('meta.tex.twig', [
            'metaNode' => $this->metaNode,
        ]);
    }
}

<?php

declare(strict_types=1);

namespace phpDocumentor\Guides\Renderers\Html;

use phpDocumentor\Guides\Nodes\SectionEndNode;
use phpDocumentor\Guides\Renderer;
use phpDocumentor\Guides\Renderers\NodeRenderer;

class SectionEndNodeRenderer implements NodeRenderer
{
    /** @var SectionEndNode */
    private $sectionEndNode;

    /** @var Renderer */
    private $renderer;

    public function __construct(SectionEndNode $sectionEndNode)
    {
        $this->sectionEndNode   = $sectionEndNode;
        $this->renderer = $sectionEndNode->getEnvironment()->getRenderer();
    }

    public function render() : string
    {
        return $this->renderer->render('section-end.html.twig', [
            'sectionEndNode' => $this->sectionEndNode,
        ]);
    }
}

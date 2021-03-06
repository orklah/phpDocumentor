<?php

declare(strict_types=1);

namespace phpDocumentor\Guides\Renderers\LaTeX;

use phpDocumentor\Guides\Nodes\TitleNode;
use phpDocumentor\Guides\Renderer;
use phpDocumentor\Guides\Renderers\NodeRenderer;

class TitleNodeRenderer implements NodeRenderer
{
    /** @var TitleNode */
    private $titleNode;

    /** @var Renderer */
    private $renderer;

    public function __construct(TitleNode $titleNode)
    {
        $this->titleNode = $titleNode;
        $this->renderer = $titleNode->getEnvironment()->getRenderer();
    }

    public function render() : string
    {
        $type = 'chapter';

        if ($this->titleNode->getLevel() > 1) {
            $type = 'section';

            for ($i = 2; $i < $this->titleNode->getLevel(); $i++) {
                $type = 'sub' . $type;
            }
        }

        return $this->renderer->render('title.tex.twig', [
            'type' => $type,
            'titleNode' => $this->titleNode,
        ]);
    }
}

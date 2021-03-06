<?php

declare(strict_types=1);

namespace phpDocumentor\Guides\Renderers\LaTeX;

use phpDocumentor\Guides\Nodes\DocumentNode;
use phpDocumentor\Guides\Nodes\MainNode;
use phpDocumentor\Guides\Renderer;
use phpDocumentor\Guides\Renderers\DocumentNodeRenderer as BaseDocumentRender;
use phpDocumentor\Guides\Renderers\FullDocumentNodeRenderer;
use phpDocumentor\Guides\Renderers\NodeRenderer;
use function count;

class DocumentNodeRenderer implements NodeRenderer, FullDocumentNodeRenderer
{
    /** @var DocumentNode */
    private $document;

    /** @var Renderer */
    private $renderer;

    public function __construct(DocumentNode $document)
    {
        $this->document = $document;
        $this->renderer = $document->getEnvironment()->getRenderer();
    }

    public function render() : string
    {
        return (new BaseDocumentRender($this->document))->render();
    }

    public function renderDocument() : string
    {
        return $this->renderer->render('document.tex.twig', [
            'isMain' => $this->isMain(),
            'document' => $this->document,
            'body' => $this->render(),
        ]);
    }

    private function isMain() : bool
    {
        return count($this->document->getNodes(static function ($node) {
            return $node instanceof MainNode;
        })) !== 0;
    }
}

<?php

declare(strict_types=1);

namespace phpDocumentor\Guides\Handlers;

use League\Flysystem\FilesystemInterface;
use phpDocumentor\Guides\Documents;
use phpDocumentor\Guides\Metas;
use phpDocumentor\Guides\RenderCommand;

final class RenderHandler
{
    /** @var Documents */
    private $documents;

    /** @var Metas */
    private $metas;

    public function __construct(Metas $metas, Documents $documents)
    {
        $this->metas = $metas;
        $this->documents = $documents;
    }

    public function handle(RenderCommand $command) : void
    {
        $targetDirectory = $command->getOutputDirectory();

        $this->render($command->getDestination(), $targetDirectory);
    }

    public function render(FilesystemInterface $destination, string $targetDirectory) : void
    {
        $basePath = $targetDirectory ? $targetDirectory . '/' : '';

        foreach ($this->documents->getAll() as $file => $document) {
            $target = $basePath . $this->getTargetOf($file);

            $directory = dirname($target);

            if ($destination->has($directory)) {
                $destination->createDir($directory);
            }

            $destination->put($target, $document->renderDocument());
        }
    }

    private function getTargetOf(string $file) : string
    {
        $metaEntry = $this->metas->get($file);

        if ($metaEntry === null) {
            throw new \InvalidArgumentException(sprintf('Could not find target file for %s', $file));
        }

        return $metaEntry->getUrl();
    }
}

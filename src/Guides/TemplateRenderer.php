<?php

declare(strict_types=1);

namespace phpDocumentor\Guides;

use phpDocumentor\Transformer\Writer\Twig\Extension;
use Twig\Environment;
use function rtrim;

final class TemplateRenderer
{
    /** @var Environment */
    private $environment;

    /** @var string */
    private $basePath;

    /** @var string */
    private $subFolder;

    public function __construct(Environment $environment, string $basePath, string $subFolder)
    {
        $this->environment = $environment;
        $this->basePath = $basePath;
        $this->subFolder = $subFolder;
    }

    public function getTemplateEngine(): Environment
    {
        return $this->environment;
    }

    public function setDestination(string $filename)
    {
        /** @var Extension $extension */
        $extension = $this->getTemplateEngine()->getExtension(Extension::class);
        $destination = $this->subFolder . '/' . $filename;
        $extension->setDestination($destination);
    }

    /**
     * @param mixed[] $parameters
     */
    public function render(string $template, array $parameters = []) : string
    {
        return rtrim($this->environment->render($this->basePath . '/' . $template, $parameters), "\n");
    }
}

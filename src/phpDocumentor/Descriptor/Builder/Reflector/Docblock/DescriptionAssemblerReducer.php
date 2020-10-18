<?php

declare(strict_types=1);

namespace phpDocumentor\Descriptor\Builder\Reflector\Docblock;

use phpDocumentor\Descriptor\Builder\AssemblerAbstract;
use phpDocumentor\Descriptor\Builder\AssemblerReducer;
use phpDocumentor\Descriptor\Descriptor;
use phpDocumentor\Descriptor\DocBlock\DescriptionDescriptor;
use phpDocumentor\Descriptor\NullDescriptor;
use phpDocumentor\Descriptor\TagDescriptor;
use phpDocumentor\Reflection\DocBlock\Tag;

/**
 * @template TDescriptor of \phpDocumentor\Descriptor\DescriptorAbstract
 * @template TInput of object
 * @extends AssemblerAbstract<TDescriptor, TInput>
 */
final class DescriptionAssemblerReducer extends AssemblerAbstract implements AssemblerReducer
{
    /**
     * @param TInput $data
     * @param TDescriptor $descriptor
     *
     * @return TDescriptor
     */
    public function create(object $data, ?Descriptor $descriptor = null) : ?Descriptor
    {
        if ($descriptor === null) {
            return null;
        }

        $description = new DescriptionDescriptor(
            $data->getDescription(),
            $data->getDescription() !== null ? $this->createTags($data->getDescription()->getTags()) : []
        );

        $descriptor->setDescription($description);

        return $descriptor;
    }

    /**
     * @param Tag[] $tags
     *
     * @return TagDescriptor[]
     */
    private function createTags(array $tags) : array
    {
        $result = [];
        foreach ($tags as $tag) {
            $tagDescriptor = $this->builder->buildDescriptor($tag, TagDescriptor::class);

            if ($tagDescriptor instanceof NullDescriptor) {
                continue;
            }

            $result[] = $tagDescriptor;
        }

        return $result;
    }
}

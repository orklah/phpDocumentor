<?php

declare(strict_types=1);

namespace phpDocumentor\Guides\Nodes;

class WrapperNode extends Node
{
    /** @var Node|null */
    protected $node;

    /** @var string|callable */
    protected $before;

    /** @var string|callable */
    protected $after;

    /**
     * @param string|callable $before
     * @param string|callable $after
     */
    public function __construct(?Node $node, $before = '', $after = '')
    {
        parent::__construct();

        if (!is_string($before) && !is_callable($before)) {
            throw new \InvalidArgumentException('$before must be a string or a callable returning a string');
        }
        if (!is_string($after) && !is_callable($after)) {
            throw new \InvalidArgumentException('$after must be a string or a callable returning a string');
        }
        $this->node   = $node;
        $this->before = $before;
        $this->after  = $after;
    }

    protected function doRender() : string
    {
        $contents = $this->node !== null ? $this->node->render() : '';

        $before = $this->before;
        if (is_callable($before)) {
            $before = $before();
        }

        $after = $this->after;
        if (is_callable($after)) {
            $after = $after();
        }

        return $before . $contents . $after;
    }
}

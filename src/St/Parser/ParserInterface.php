<?php

namespace St\Parser;

/**
 * Interface ParserInterface
 * @package St\Parser
 */
interface ParserInterface
{
    /**
     * @param $resource
     * @return mixed
     */
    public function parse($resource);
}

<?php

namespace St\Base;
use St\Base\CommandInterface;

/**
 * Class CommandAbstract
 *
 * @package St\Command
 */
abstract class CommandAbstract implements CommandInterface
{
    /**
     * @var
     */
    protected $name;

    /**
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}

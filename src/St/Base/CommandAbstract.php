<?php

namespace St\Base;
use St\Db\Query;

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

    /** @var Query */
    protected $db;

    /**
     * @param string $name
     * @param Query $db
     */
    public function __construct($name, Query $db)
    {
        $this->name = $name;
        $this->db = $db;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}

<?php

namespace St;

use St\Base\CommandInterface;

/**
 * Приложения для сбора статистики.
 *
 * @package St
 */
class St
{
    /**
     * Список команд.
     *
     * @var CommandInterface[]
     */
    private $commands = [];

    /**
     * Выполнение всех команд.
     */
    public function run()
    {
        foreach ($this->commands as $command)
        {
            $command->run();
        }
    }

    /**
     * Добавление команды.
     *
     * @param CommandInterface $command
     */
    public function addCommand(CommandInterface $command)
    {
        $this->commands[] = $command;
    }

}

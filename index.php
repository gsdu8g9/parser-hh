<?php

error_reporting(E_ALL);

define('ROOT_DIR', __DIR__);

require_once ROOT_DIR . DIRECTORY_SEPARATOR . '/vendor/autoload.php';

$st = new \St\St();

$collectVacanciesCountPhpCommand = new \St\Command\CollectVacanciesCountCommand(
    'collectVacanciesCountCommandPhp',
    new \St\Command\VacanciesCountQueryParams('php', 1)
);
$collectVacanciesCountPhpCommand->setParser(new \St\Parser\SimpleHtmlParser());
$st->addCommand($collectVacanciesCountPhpCommand);

$collectVacanciesCountPythonCommand = new \St\Command\CollectVacanciesCountCommand(
    'collectVacanciesCountCommandPython',
    new \St\Command\VacanciesCountQueryParams('python', 1)
);
$collectVacanciesCountPythonCommand->setParser(new \St\Parser\SimpleHtmlParser());
$st->addCommand($collectVacanciesCountPythonCommand);

$collectVacanciesCountJavaScriptCommand = new \St\Command\CollectVacanciesCountCommand(
    'collectVacanciesCountCommandJavascript',
    new \St\Command\VacanciesCountQueryParams('javascript', 1)
);

$collectVacanciesCountJavaScriptCommand->setParser(new \St\Parser\SimpleHtmlParser());

$st->addCommand($collectVacanciesCountJavaScriptCommand);

$st->run();

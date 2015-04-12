<?php

error_reporting(E_ALL);

define('ROOT_DIR', __DIR__);

require_once ROOT_DIR . DIRECTORY_SEPARATOR . '/vendor/autoload.php';

$st = new \St\St();

$collectVacanciesCountPhpCommand = new \St\Command\CollectVacanciesCountCommand(
    'collectVacanciesCountPHP',
    'http://hh.ru/search/vacancy?text=php&area=1'
);
$collectVacanciesCountPhpCommand->setParser(new \St\Parser\SimpleHtmlParser());
$st->addCommand($collectVacanciesCountPhpCommand);

$collectVacanciesCountPythonCommand = new \St\Command\CollectVacanciesCountCommand(
    'collectVacanciesCountCommandPython',
    'http://hh.ru/search/vacancy?text=python&area=1'
);
$collectVacanciesCountPythonCommand->setParser(new \St\Parser\SimpleHtmlParser());
$st->addCommand($collectVacanciesCountPythonCommand);

$st->run();

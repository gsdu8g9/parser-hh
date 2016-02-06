<?php

use St\St;
use St\Command\VacanciesCountQueryParams;
use St\Command\CollectVacanciesCountCommand;
use St\Parser\SimpleHtmlParser;
use St\Db\Query;

error_reporting(E_ALL);

define('ROOT_DIR', __DIR__);

require_once ROOT_DIR . DIRECTORY_SEPARATOR . '/vendor/autoload.php';

$st = new St();

$collectVacanciesCountCommand = new CollectVacanciesCountCommand(
    'collectVacanciesCountCommand',
    new Query('mysql:host=localhost;dbname=st', 'root', 'root'),
    new SimpleHtmlParser()
);
$collectVacanciesCountCommand->addVacancy(
    new VacanciesCountQueryParams('php', VacanciesCountQueryParams::CODE_CITY_MOSCOW)
);
$collectVacanciesCountCommand->addVacancy(
    new VacanciesCountQueryParams('php', VacanciesCountQueryParams::CODE_CITY_ULYANOVSK)
);
$collectVacanciesCountCommand->addVacancy(
    new VacanciesCountQueryParams('python', VacanciesCountQueryParams::CODE_CITY_MOSCOW)
);
$collectVacanciesCountCommand->addVacancy(
    new VacanciesCountQueryParams('python', VacanciesCountQueryParams::CODE_CITY_ULYANOVSK)
);
$collectVacanciesCountCommand->addVacancy(
    new VacanciesCountQueryParams('javascript', VacanciesCountQueryParams::CODE_CITY_MOSCOW)
);
$collectVacanciesCountCommand->addVacancy(
    new VacanciesCountQueryParams('javascript', VacanciesCountQueryParams::CODE_CITY_ULYANOVSK)
);
$collectVacanciesCountCommand->addVacancy(
    new VacanciesCountQueryParams('golang', VacanciesCountQueryParams::CODE_CITY_MOSCOW)
);
$collectVacanciesCountCommand->addVacancy(
    new VacanciesCountQueryParams('golang', VacanciesCountQueryParams::CODE_CITY_ULYANOVSK)
);
$collectVacanciesCountCommand->addVacancy(
    new VacanciesCountQueryParams('java', VacanciesCountQueryParams::CODE_CITY_MOSCOW)
);
$collectVacanciesCountCommand->addVacancy(
    new VacanciesCountQueryParams('java', VacanciesCountQueryParams::CODE_CITY_ULYANOVSK)
);
$collectVacanciesCountCommand->addVacancy(
    new VacanciesCountQueryParams('rust', VacanciesCountQueryParams::CODE_CITY_MOSCOW)
);
$collectVacanciesCountCommand->addVacancy(
    new VacanciesCountQueryParams('haskell', VacanciesCountQueryParams::CODE_CITY_MOSCOW)
);
$collectVacanciesCountCommand->addVacancy(
    new VacanciesCountQueryParams('erlang', VacanciesCountQueryParams::CODE_CITY_MOSCOW)
);

$st->addCommand($collectVacanciesCountCommand);

$st->run();

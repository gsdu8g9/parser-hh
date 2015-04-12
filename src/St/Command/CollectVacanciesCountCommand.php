<?php

namespace St\Command;

use St\Base\CommandAbstract;
use St\Parser\ParserInterface;

class CollectVacanciesCountCommand extends CommandAbstract
{
    /**
     * Парсер для парсинга сайта hh.ru.
     *
     * @var ParserInterface
     */
    private $parser;

    /**
     * Шаблон урл для запроса.
     *
     * @var string
     */
    private $queryUrlPattern = 'http://hh.ru/search/vacancy?text=%s&area=%u';

    /**
     * Объект с параметрами запроса.
     *
     * @var VacanciesCountQueryParams
     */
    private $queryParams;

    /**
     * @param $name
     * @param VacanciesCountQueryParams $queryParams
     */
    public function __construct($name, VacanciesCountQueryParams $queryParams)
    {
        parent::__construct($name);
        $this->queryParams = $queryParams;
    }

    /**
     * @return mixed
     */
    public function run()
    {
        $parsed = $this->parser->parse($this->generateQueryUrl());
        $foundResult = current($parsed->find('.resumesearch__result-count'));
        preg_match('/\d\s\d+|\d+/', $foundResult->innertext(), $matches);
        $countVacancies = str_replace(' ', '', $matches[0]);

        // @todo внедрить PDO
        $addRecord = 'insert into `vacancien_count` (`search_string`, `find_result`) values ("' . $this->queryParams->getVacancy() . '", "' . $countVacancies . '")';
        try {
            $dbc = new \PDO('mysql:host=localhost;dbname=st', 'root', 'root');
            $dbc->exec($addRecord);
        } catch (\PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    private function generateQueryUrl()
    {
        return sprintf($this->queryUrlPattern, $this->queryParams->getVacancy(), $this->queryParams->getCityId());
    }

    public function setParser(ParserInterface $parser)
    {
        $this->parser = $parser;
    }

}

<?php

namespace St\Command;

use St\Base\CommandAbstract;
use St\Db\Query;
use St\Parser\ParserInterface;

/**
 * Команда для сбора количества вакансий.
 *
 * @package St\Command
 */
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
     * Массив вакансий, для которых необходимо собирать статичтику.
     *
     * @var VacanciesCountQueryParams[]
     */
    private $vacancies = [];

    /**
     * Инициализация данных.
     *
     * @param string $name Название команды.
     * @param Query $db
     * @param ParserInterface $parser Паресер.
     */
    public function __construct($name, Query $db, ParserInterface $parser)
    {
        parent::__construct($name, $db);
        $this->parser = $parser;
    }

    /**
     * Сбор статистики количества вакансий.
     */
    public function run()
    {
        if (empty($this->vacancies)) {
            return false;
        }

        foreach ($this->vacancies as $vacancy) {
            /** @var \simple_html_dom $parsed */
            $parsed = $this->parser->parse(
                $this->generateQueryUrl($vacancy->getVacancy(), $vacancy->getCityId())
            );

            $foundResult = current($parsed->find('.resumesearch__result-count'));
            $countVacancies = preg_replace('~[^\d]~', '', explode(' ', $foundResult->innertext())[1]);

            try {
                $this->db->query(sprintf(
                    'insert into vac (city_id, search_string, find_result) values ("%u", "%s", "%u")',
                    $vacancy->getCityId(),
                    $vacancy->getVacancy(),
                    $countVacancies
                ));
            } catch (\PDOException $exc) {
                echo $exc->getMessage();
                die();
            }
        }

    }

    /**
     * Добавление параметров запроса для сбора статистики вакансии.
     *
     * @param VacanciesCountQueryParams $countQueryParams Контейнер для хранения параметров запроса для сбора статистики.
     */
    public function addVacancy(VacanciesCountQueryParams $countQueryParams)
    {
        $this->vacancies[] = $countQueryParams;
    }

    /**
     * Установка парсера.
     *
     * @param ParserInterface $parser Парсер.
     */
    public function setParser(ParserInterface $parser)
    {
        $this->parser = $parser;
    }

    /**
     * Генерация урл для запроса получения статистики.
     *
     * @param string $vacancy Название вакансии.
     * @param int $city Идентификатор города.
     *
     * @return string Сгенерированный урл для запроса.
     */
    private function generateQueryUrl($vacancy, $city)
    {
        return sprintf($this->queryUrlPattern, $vacancy, $city);
    }

}
